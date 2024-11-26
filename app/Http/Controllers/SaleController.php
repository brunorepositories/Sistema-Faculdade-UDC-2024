<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\AccountReceivable;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\PaymentTerm;
use App\Models\Product;
use App\Models\SaleProducts;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
  protected function formatDecimalValue($value)
  {
    if (is_null($value)) {
      return null;
    }

    // Remove todos os caracteres exceto números, ponto e vírgula
    $value = preg_replace('/[^\d.,]/', '', $value);

    // Substitui vírgula por ponto
    $value = str_replace(',', '.', $value);

    // Se houver mais de um ponto, mantém apenas o último
    $value = preg_replace('/\.(?=.*\.)/', '', $value);

    return $value ? (float) $value : null;
  }

  protected function formatSaleData($data)
  {
    // Formata valores monetários
    $data['valorFrete'] = $this->formatDecimalValue($data['valorFrete']);
    $data['valorSeguro'] = $this->formatDecimalValue($data['valorSeguro']);
    $data['outrasDespesas'] = $this->formatDecimalValue($data['outrasDespesas']);
    $data['subTotal'] = $this->formatDecimalValue($data['subTotal']);
    $data['desconto'] = $this->formatDecimalValue($data['desconto']);
    $data['acrescimo'] = $this->formatDecimalValue($data['acrescimo']);
    $data['totalProdutos'] = $this->formatDecimalValue($data['totalProdutos']);
    $data['totalPagar'] = $this->formatDecimalValue($data['totalPagar']);

    // Formata produtos
    if (isset($data['produtos']) && is_array($data['produtos'])) {
      foreach ($data['produtos'] as $key => $produto) {
        $data['produtos'][$key]['precoVenda'] = $this->formatDecimalValue($produto['precoVenda']);
        $data['produtos'][$key]['descontoProduto'] = $this->formatDecimalValue($produto['descontoProduto'] ?? 0);
        $data['produtos'][$key]['acrescimoProduto'] = $this->formatDecimalValue($produto['acrescimoProduto'] ?? 0);
        $data['produtos'][$key]['qtdProduto'] = $this->formatDecimalValue($produto['qtdProduto']);
        $data['produtos'][$key]['percentualComissao'] = $this->formatDecimalValue($produto['percentualComissao'] ?? 0);
      }
    }

    // Formata parcelas
    if (isset($data['parcelas']) && is_array($data['parcelas'])) {
      foreach ($data['parcelas'] as $key => $parcela) {
        $data['parcelas'][$key]['valor'] = $this->formatDecimalValue($parcela['valor']);
      }
    }

    return $data;
  }

  /**
   * Display a listing of the resource.
   */
  public function index(Sale $sale)
  {
    $sales = $sale->with('paymentTerm', 'customer')
      ->orderBy('updated_at', 'desc')
      ->paginate(10);

    return view('content.sale.index', compact('sales'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $customers = Customer::where('ativo', true)->orderBy('id')->get();
    $paymentTerms = PaymentTerm::where('ativo', true)->with('installments')->orderBy('id')->get();
    $products = Product::where('ativo', true)->where('estoque', '>', 0)->orderBy('id')->with('measure')->get();

    return view('content.sale.create', compact('customers', 'paymentTerms', 'products'));
  }

  /**
   * Verifica se há estoque disponível para a venda
   */
  private function verificarEstoque($produtos)
  {
    foreach ($produtos as $produto) {
      $product = Product::find($produto['product_id']);
      if ($product->estoque < $produto['qtdProduto']) {
        throw new \Exception("Estoque insuficiente para o produto {$product->nome}. Disponível: {$product->estoque}");
      }
    }
    return true;
  }

  /**
   * Calcula comissão do produto
   */
  private function calcularComissao($precoVenda, $custoMedio, $percentualComissao)
  {
    $lucro = $precoVenda - $custoMedio;
    return round(($lucro * $percentualComissao) / 100, 2);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(SaleRequest $request)
  {
    try {
      // Formata os dados antes de prosseguir
      $formattedData = $this->formatSaleData($request->all());

      DB::transaction(function () use ($formattedData) {
        // Verifica estoque disponível
        $this->verificarEstoque($formattedData['produtos']);

        // Dados da venda
        $saleData = collect($formattedData)->only([
          'numeroNota',
          'modelo',
          'serie',
          'customer_id',
          'dataEmissao',
          'dataSaida',
          'valorFrete',
          'valorSeguro',
          'outrasDespesas',
          'subTotal',
          'desconto',
          'acrescimo',
          'totalProdutos',
          'totalPagar',
          'payment_term_id',
        ])->toArray();

        // Criação da venda
        $sale = Sale::create($saleData);

        // Processa cada produto
        foreach ($formattedData['produtos'] as $productData) {
          $product = Product::find($productData['product_id']);

          // Calcula valor da comissão
          $valorComissao = $this->calcularComissao(
            $productData['precoVenda'],
            $product->custoMedio,
            $productData['percentualComissao'] ?? 0
          );

          // Criação do relacionamento na tabela sale_products
          SaleProducts::create([
            'numeroNota' => $sale->numeroNota,
            'modelo' => $sale->modelo,
            'serie' => $sale->serie,
            'customer_id' => $sale->customer_id,
            'product_id' => $productData['product_id'],
            'precoVenda' => $productData['precoVenda'],
            'qtdProduto' => $productData['qtdProduto'],
            'descontoProduto' => $productData['descontoProduto'] ?? 0,
            'acrescimoProduto' => $productData['acrescimoProduto'] ?? 0,
            'custoMedio' => $product->custoMedio,
            'custoUltVenda' => $productData['precoVenda'],
            'valorComissao' => $valorComissao,
            'percentualComissao' => $productData['percentualComissao'] ?? 0,
          ]);

          // Atualiza o produto no estoque
          $product->update([
            'estoque' => DB::raw("estoque - {$productData['qtdProduto']}"),
            'custoUltimaVenda' => $productData['precoVenda'],
            'dtUltimaVenda' => $sale->dataSaida,
          ]);
        }

        // Processa as parcelas e cria o contas a receber
        if (isset($formattedData['parcelas']) && !empty($formattedData['parcelas'])) {
          foreach ($formattedData['parcelas'] as $parcela) {
            AccountReceivable::create([
              'numeroNota' => $sale->numeroNota,
              'modelo' => $sale->modelo,
              'serie' => $sale->serie,
              'customer_id' => $sale->customer_id,
              'parcela' => $parcela['parcela'],
              'valorParcela' => $parcela['valor'],
              'dataVencimento' => $parcela['dataVencimento'],
              'payment_form_id' => $parcela['payment_form_id'],
              'status' => 'pendente',
            ]);
          }
        }
      });

      return to_route('sale.index')->with('success', 'Venda cadastrada com sucesso.');
    } catch (\Exception $e) {
      Log::error('Erro ao cadastrar venda: ' . $e->getMessage());
      return to_route('sale.index')->with('failed', 'Ops, algo deu errado: ' . $e->getMessage());
    }
  }

  /**
   * Cancela a venda e reverte o estoque
   */
  public function cancel(Sale $sale)
  {
    try {
      DB::transaction(function () use ($sale) {
        // Carrega os produtos da venda
        $saleProducts = SaleProducts::where([
          'numeroNota' => $sale->numeroNota,
          'modelo' => $sale->modelo,
          'serie' => $sale->serie,
          'customer_id' => $sale->customer_id
        ])->get();

        // Reverte o estoque para cada produto
        foreach ($saleProducts as $item) {
          Product::where('id', $item->product_id)->update([
            'estoque' => DB::raw("estoque + {$item->qtdProduto}")
          ]);
        }

        // Marca a venda como cancelada
        $sale->update([
          'dataCancelamento' => now()
        ]);

        // Cancela as parcelas pendentes
        AccountReceivable::where([
          'numeroNota' => $sale->numeroNota,
          'modelo' => $sale->modelo,
          'serie' => $sale->serie,
          'customer_id' => $sale->customer_id
        ])
          ->where('status', 'pendente')
          ->update([
            'status' => 'cancelado',
            'dataCancelamento' => now()
          ]);
      });

      return to_route('sale.index')->with('success', 'Venda cancelada com sucesso.');
    } catch (QueryException $e) {
      Log::error('Erro ao cancelar venda: ' . $e->getMessage());
      return to_route('sale.index')
        ->with('failed', 'Ops, algo deu errado ao cancelar a venda, tente novamente.');
    }
  }

  public function show($numeroNota, $modelo, $serie, $customer_id)
  {
    try {
      $sale = Sale::where([
        'numeroNota' => $numeroNota,
        'modelo' => $modelo,
        'serie' => $serie,
        'customer_id' => $customer_id
      ])->with([
        'products' => function ($query) {
          $query->withPivot([
            'precoVenda',
            'qtdProduto',
            'descontoProduto',
            'acrescimoProduto',
            'custoMedio',
            'custoUltVenda',
            'valorComissao',
            'percentualComissao'
          ]);
        },
        'products.measure',
        'customer',
        'paymentTerm',
        'accountReceivables.paymentForm'
      ])->firstOrFail();

      // Calcula totais
      $totals = [
        'totalQuantidade' => $sale->products->sum('pivot.qtdProduto'),
        'totalBruto' => $sale->products->sum(function ($product) {
          return $product->pivot->precoVenda * $product->pivot->qtdProduto;
        }),
        'totalDesconto' => $sale->products->sum(function ($product) {
          return ($product->pivot->precoVenda * $product->pivot->qtdProduto * $product->pivot->descontoProduto) / 100;
        }),
        'totalAcrescimo' => $sale->products->sum(function ($product) {
          return ($product->pivot->precoVenda * $product->pivot->qtdProduto * $product->pivot->acrescimoProduto) / 100;
        }),
        'totalComissao' => $sale->products->sum('pivot.valorComissao'),
      ];

      return view('sale.show', compact('sale', 'totals'));
    } catch (ModelNotFoundException $e) {
      Log::error('Venda não encontrada: ' . $e->getMessage());
      return to_route('sale.index')
        ->with('error', 'Venda não encontrada.');
    }
  }

  /**
   * Verifica se a nota fiscal já existe
   */
  public function checkSale(Request $request)
  {
    $saleData = $request->only([
      'numeroNota',
      'modelo',
      'serie',
      'customer_id',
    ]);

    try {
      $exists = Sale::where('numeroNota', $saleData['numeroNota'])
        ->where('modelo', $saleData['modelo'])
        ->where('serie', $saleData['serie'])
        ->where('customer_id', $saleData['customer_id'])
        ->exists();

      return response()->json([
        'success' => true,
        'message' => $exists ? 'Nota fiscal já cadastrada no sistema.' : 'Nenhum registro encontrado.',
        'exists' => $exists
      ], 200);
    } catch (QueryException $e) {
      Log::error('Erro ao verificar nota de venda: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Erro ao verificar nota de venda.'
      ], 500);
    }
  }
}
