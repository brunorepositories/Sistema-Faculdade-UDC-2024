<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\AccountPayable;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PaymentTerm;
use App\Models\Product;
use App\Models\PurchaseProducts;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
  /**
   * Calcula o rateio das despesas adicionais para cada produto
   */
  private function calcularRateio($produtos, $valorFrete, $valorSeguro, $outrasDespesas)
  {
    $totalDespesas = $valorFrete + $valorSeguro + $outrasDespesas;

    if ($totalDespesas <= 0) {
      return array_fill_keys(array_keys($produtos), 0);
    }

    $valorTotalCompra = array_reduce($produtos, function ($total, $produto) {
      return $total + ($produto['precoProduto'] * $produto['qtdProduto']);
    }, 0);

    $rateios = [];
    foreach ($produtos as $id => $produto) {
      $valorProduto = $produto['precoProduto'] * $produto['qtdProduto'];
      $percentual = $valorProduto / $valorTotalCompra;
      $rateios[$id] = round($totalDespesas * $percentual, 2);
    }

    return $rateios;
  }

  /**
   * Calcula o novo custo médio do produto
   */
  private function calcularCustoMedio($produto_id, $qtdNova, $custoNovo, $valorRateio = 0)
  {
    $produto = Product::find($produto_id);

    // Custo unitário considerando o rateio
    $custoUnitarioTotal = $custoNovo + ($valorRateio / $qtdNova);

    // Cálculo do custo médio ponderado
    $valorEstoqueAtual = $produto->estoque * $produto->custoMedio;
    $valorNovaCompra = $qtdNova * $custoUnitarioTotal;

    $novaQuantidadeTotal = $produto->estoque + $qtdNova;

    if ($novaQuantidadeTotal == 0) {
      return $custoUnitarioTotal;
    }

    return round(($valorEstoqueAtual + $valorNovaCompra) / $novaQuantidadeTotal, 2);
  }

  /**
   * Exibe o dashboard com as compras
   */
  public function dashboard(Purchase $purchase)
  {
    $purchases = $purchase->with('paymentTerm', 'supplier')
      ->orderBy('updated_at', 'desc')
      ->paginate(10);

    return view('content.dashboard.dashboards-analytics', compact('purchases'));
  }

  /**
   * Display a listing of the resource.
   */
  public function index(Purchase $purchase)
  {
    $purchases = $purchase->with('paymentTerm', 'supplier')
      ->orderBy('updated_at', 'desc')
      ->paginate(10);

    return view('content.purchase.index', compact('purchases'));
  }

  /**
   * Exporta as compras para CSV
   */
  public function export()
  {
    $purchases = Purchase::with(['supplier', 'paymentTerm'])->get();

    $csvData = [];
    $csvData[] = [
      'ID',
      'Número da Nota',
      'Modelo',
      'Série',
      'Data de Emissão',
      'Data de Chegada',
      'Tipo de Frete',
      'Valor do Frete',
      'Valor do Seguro',
      'Outras Despesas',
      'Total dos Produtos',
      'Total a Pagar',
      'Observação',
      'Fornecedor',
      'Condição de Pagamento',
      'Data de Cancelamento'
    ];

    foreach ($purchases as $purchase) {
      $csvData[] = [
        $purchase->id,
        $purchase->numeroNota,
        $purchase->modelo,
        $purchase->serie,
        $purchase->dataEmissao ? \Carbon\Carbon::parse($purchase->dataEmissao)->format('d/m/Y') : '-',
        $purchase->dataChegada ? \Carbon\Carbon::parse($purchase->dataChegada)->format('d/m/Y') : '-',
        $purchase->tipoFrete ? 'CIF' : 'FOB',
        number_format($purchase->valorFrete, 2, ',', '.'),
        number_format($purchase->valorSeguro, 2, ',', '.'),
        number_format($purchase->outrasDespesas, 2, ',', '.'),
        number_format($purchase->totalProdutos, 2, ',', '.'),
        number_format($purchase->totalPagar, 2, ',', '.'),
        $purchase->observacao ?? '-',
        $purchase->supplier->nome ?? '-',
        $purchase->paymentTerm->nome ?? '-',
        $purchase->dataCancelamento ? \Carbon\Carbon::parse($purchase->dataCancelamento)->format('d/m/Y H:i') : '-'
      ];
    }

    $filename = 'compras-export_' . now()->format('dmY-Hi') . '.csv';
    $handle = fopen('php://temp', 'w');

    foreach ($csvData as $row) {
      fputcsv($handle, $row, ';');
    }

    rewind($handle);
    $content = stream_get_contents($handle);
    fclose($handle);

    return response($content)
      ->header('Content-Type', 'text/csv')
      ->header('Content-Disposition', "attachment; filename=\"$filename\"");
  }

  /**
   * Verifica se a nota fiscal já existe
   */
  public function checkPurchase(Request $request)
  {
    $purchaseData = $request->only([
      'numeroNota',
      'modelo',
      'serie',
      'supplier_id',
    ]);

    try {
      $exists = Purchase::where('numeroNota', $purchaseData['numeroNota'])
        ->where('modelo', $purchaseData['modelo'])
        ->where('serie', $purchaseData['serie'])
        ->where('supplier_id', $purchaseData['supplier_id'])
        ->exists();

      return response()->json([
        'success' => true,
        'message' => $exists ? 'Nota fiscal já cadastrada no sistema.' : 'Nenhum registro encontrado.',
        'exists' => $exists
      ], 200);
    } catch (QueryException $e) {
      Log::error('Erro ao verificar nota de compra: ' . $e->getMessage());

      return response()->json([
        'success' => false,
        'message' => 'Ops, algo deu errado ao verificar a nota de compra, tente novamente.'
      ], 500);
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $fornecedores = Supplier::where('ativo', true)->orderBy('id')->get();
    $paymentTerms = PaymentTerm::where('ativo', true)->with('installments')->orderBy('id')->get();
    $products = Product::where('ativo', true)->orderBy('id')->with('measure')->get();
    $suppliers = Supplier::where('ativo', true)->orderBy('id')->get();

    return view('content.purchase.create', compact('fornecedores', 'paymentTerms', 'products', 'suppliers'));
  }

  public function store(PurchaseRequest $request)
  {

    // dd($request->all());
    try {
      DB::transaction(function () use ($request) {
        // Dados da compra
        $purchaseData = $request->only([
          'numeroNota',
          'modelo',
          'serie',
          'supplier_id',
          'dataEmissao',
          'dataChegada',
          'tipoFrete',
          'valorFrete',
          'valorSeguro',
          'outrasDespesas',
          'totalProdutos',
          'totalPagar',
          'payment_term_id',
        ]);

        // Criação da compra
        $purchase = Purchase::create($purchaseData);

        // Prepara dados para cálculo do rateio
        $produtosParaRateio = [];

        // dd($request->all());
        foreach ($request->produtos as $product) {
          $produtosParaRateio[$product['product_id']] = [
            'precoProduto' => $product['precoProduto'],
            'qtdProduto' => $product['qtdProduto']
          ];
        }

        // Calcula rateio para cada produto
        $rateios = $this->calcularRateio(
          $produtosParaRateio,
          $purchase->valorFrete,
          $purchase->valorSeguro,
          $purchase->outrasDespesas
        );

        // Processa cada produto
        foreach ($request->produtos as $productData) {
          $product_id = $productData['product_id'];
          $valorRateio = $rateios[$product_id] ?? 0;

          // Calcula o novo custo médio
          $custoMedio = $this->calcularCustoMedio(
            $product_id,
            $productData['qtdProduto'],
            $productData['precoProduto'],
            $valorRateio
          );

          // Custo unitário com rateio
          $custoUltCompra = $productData['precoProduto'] +
            ($valorRateio / $productData['qtdProduto']);

          // Criação do relacionamento na tabela purchase_products
          PurchaseProducts::create([
            'numeroNota' => $purchase->numeroNota,
            'modelo' => $purchase->modelo,
            'serie' => $purchase->serie,
            'supplier_id' => $purchase->supplier_id,
            'product_id' => $product_id,
            'precoProduto' => $productData['precoProduto'],
            'qtdProduto' => $productData['qtdProduto'],
            'descontoProduto' => $productData['descontoProduto'] ?? 0,
            'custoMedio' => $custoMedio,
            'custoUltCompra' => round($custoUltCompra, 2),
            'rateio' => $valorRateio,
          ]);

          // Atualiza o produto no estoque
          Product::where('id', $product_id)->update([
            'precoCusto' => $custoMedio,
            'custoUltimaCompra' => round($custoUltCompra, 2),
            'estoque' => DB::raw("estoque + {$productData['qtdProduto']}")
          ]);
        }

        // Processa as parcelas e cria o contas a receber
        if (isset($request->parcelas) && !empty($request->parcelas)) {
          foreach ($request->parcelas as $parcela) {
            // Cria o registro no contas a receber
            AccountPayable::create([
              // Campos de identificação
              'numeroNota' => $purchase->numeroNota,
              'modelo' => $purchase->modelo,
              'serie' => $purchase->serie,
              'supplier_id' => $purchase->supplier_id,
              'parcela' => $parcela['parcela'],

              // Campos de valor
              'valorParcela' => $parcela['valor'],
              'valorPago' => null,
              'juros' => null,
              'multa' => null,
              'desconto' => null,

              // Datas
              'dataVencimento' => $parcela['dataVencimento'],
              'dataPagamento' => null,
              'dataCancelamento' => null,

              // Relacionamentos
              'payment_form_id' => $parcela['payment_form_id'],

              // Status e observações
              'status' => 'pendente',
            ]);
          }
        }
      });

      return to_route('purchase.index')->with('success', 'Nota de compra cadastrada com sucesso.');
    } catch (QueryException $e) {
      Log::error('Erro ao cadastrar nota de compra: ' . $e->getMessage());
      return to_route('purchase.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Purchase $purchase)
  {
    $purchase->load(['supplier', 'paymentTerm', 'purchaseProducts.product']);
    return view('content.purchase.show', compact('purchase'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Purchase $purchase)
  {
    try {
      $purchase->load(['supplier', 'paymentTerm']);

      $fornecedores = Supplier::where('ativo', true)->get();
      $paymentTerms = PaymentTerm::where('ativo', true)->get();

      return view('content.purchase.edit', compact('purchase', 'fornecedores', 'paymentTerms'));
    } catch (QueryException $e) {
      Log::error('Erro ao carregar nota de compra para edição: ' . $e->getMessage());
      return to_route('purchase.index')
        ->with('failed', 'Ops, algo deu errado ao carregar os dados para edição, tente novamente.');
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(PurchaseRequest $request, Purchase $purchase)
  {
    try {
      DB::transaction(function () use ($request, $purchase) {
        $purchaseData = $request->only([
          'numeroNota',
          'modelo',
          'serie',
          'supplier_id',
          'dataEmissao',
          'dataChegada',
          'tipoFrete',
          'valorFrete',
          'valorSeguro',
          'outrasDespesas',
          'totalProdutos',
          'totalPagar',
          'payment_term_id',
          'observacao'
        ]);

        $purchase->update($purchaseData);
      });

      return to_route('purchase.index')->with('success', 'Nota de compra atualizada com sucesso.');
    } catch (QueryException $e) {
      Log::error('Erro ao atualizar nota de compra: ' . $e->getMessage());
      return to_route('purchase.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Cancela a nota de compra e reverte o estoque
   */
  public function cancel(Purchase $purchase)
  {
    try {
      DB::transaction(function () use ($purchase) {
        // Carrega os produtos da compra
        $purchaseProducts = PurchaseProducts::where([
          'numeroNota' => $purchase->numeroNota,
          'modelo' => $purchase->modelo,
          'serie' => $purchase->serie,
          'supplier_id' => $purchase->supplier_id
        ])->get();

        // Reverte o estoque e custos para cada produto
        foreach ($purchaseProducts as $item) {
          $produto = Product::find($item->product_id);

          // Remove a estoque do estoque
          $novaQuantidade = $produto->estoque - $item->qtdProduto;

          // Recalcula o custo médio sem esta compra
          if ($novaQuantidade > 0) {
            $valorEstoqueSemCompra = ($produto->estoque * $produto->custoMedio) -
              ($item->qtdProduto * $item->custoMedio);
            $novoCustoMedio = round($valorEstoqueSemCompra / $novaQuantidade, 2);
          } else {
            $novoCustoMedio = $produto->custoMedio;
          }

          // Atualiza o produto
          $produto->update([
            'estoque' => $novaQuantidade,
            'custoMedio' => $novoCustoMedio
          ]);
        }

        // Marca a compra como cancelada
        $purchase->update([
          'dataCancelamento' => now()
        ]);
      });

      return to_route('purchase.index')->with('success', 'Nota de compra cancelada com sucesso.');
    } catch (QueryException $e) {
      Log::error('Erro ao cancelar nota de compra: ' . $e->getMessage());
      return to_route('purchase.index')
        ->with('failed', 'Ops, algo deu errado ao cancelar a nota, tente novamente.');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Purchase $purchase)
  {
    try {
      if ($purchase->dataCancelamento) {
        DB::transaction(function () use ($purchase) {
          // Remove primeiro os produtos relacionados
          PurchaseProducts::where([
            'numeroNota' => $purchase->numeroNota,
            'modelo' => $purchase->modelo,
            'serie' => $purchase->serie,
            'supplier_id' => $purchase->supplier_id
          ])->delete();

          // Remove a compra
          $purchase->delete();
        });

        return to_route('purchase.index')
          ->with('success', 'Nota de compra excluída com sucesso.');
      }

      return to_route('purchase.index')
        ->with('failed', 'Não é possível excluir uma nota de compra que não está cancelada.');
    } catch (QueryException $e) {
      Log::error('Erro ao excluir nota de compra: ' . $e->getMessage());
      return to_route('purchase.index')
        ->with('failed', 'Ops, algo deu errado ao excluir a nota, tente novamente.');
    }
  }

  /**
   * Busca notas de compra com filtros
   */
  public function buscar(Request $request)
  {
    try {
      $query = Purchase::query();

      // Aplica filtro de texto
      if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
          $q->where('numeroNota', 'like', "%{$search}%")
            ->orWhereHas('supplier', function ($q) use ($search) {
              $q->where('nome', 'like', "%{$search}%")
                ->orWhere('razaoSocial', 'like', "%{$search}%");
            });
        });
      }

      // Filtro de data
      if ($dataInicio = $request->input('dataInicio')) {
        $query->whereDate('dataEmissao', '>=', $dataInicio);
      }
      if ($dataFim = $request->input('dataFim')) {
        $query->whereDate('dataEmissao', '<=', $dataFim);
      }

      // Filtro de fornecedor
      if ($supplier_id = $request->input('supplier_id')) {
        $query->where('supplier_id', $supplier_id);
      }

      // Filtro de status
      if ($request->has('canceladas')) {
        if ($request->input('canceladas')) {
          $query->whereNotNull('dataCancelamento');
        } else {
          $query->whereNull('dataCancelamento');
        }
      }

      // Ordenação
      $query->orderBy(
        $request->input('sortBy', 'updated_at'),
        $request->input('sortOrder', 'desc')
      );

      // Carrega relacionamentos necessários
      $query->with(['supplier', 'paymentTerm']);

      // Paginação
      $purchases = $query->paginate($request->input('perPage', 10));

      return response()->json([
        'success' => true,
        'data' => $purchases
      ]);
    } catch (QueryException $e) {
      Log::error('Erro ao buscar notas de compra: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Erro ao buscar notas de compra'
      ], 500);
    }
  }

  /**
   * Retorna detalhes dos produtos de uma compra
   */
  public function getPurchaseProducts(Purchase $purchase)
  {
    try {
      $products = PurchaseProducts::where([
        'numeroNota' => $purchase->numeroNota,
        'modelo' => $purchase->modelo,
        'serie' => $purchase->serie,
        'supplier_id' => $purchase->supplier_id
      ])
        ->with('product.measure')
        ->get();

      return response()->json([
        'success' => true,
        'data' => $products
      ]);
    } catch (QueryException $e) {
      Log::error('Erro ao buscar produtos da compra: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Erro ao buscar produtos da compra'
      ], 500);
    }
  }

  /**
   * Gera relatório de compras por período
   */
  public function relatorio(Request $request)
  {
    try {
      $dataInicio = $request->input('dataInicio');
      $dataFim = $request->input('dataFim');

      $query = Purchase::query()
        ->whereBetween('dataEmissao', [$dataInicio, $dataFim])
        ->whereNull('dataCancelamento')
        ->with(['supplier', 'purchaseProducts.product']);

      $compras = $query->get();

      $totais = [
        'valorTotal' => $compras->sum('totalPagar'),
        'qtdCompras' => $compras->count(),
        'qtdFornecedores' => $compras->pluck('supplier_id')->unique()->count(),
        'valorFrete' => $compras->sum('valorFrete'),
        'valorSeguro' => $compras->sum('valorSeguro'),
        'outrasDespesas' => $compras->sum('outrasDespesas')
      ];

      // Agrupamento por fornecedor
      $porFornecedor = $compras->groupBy('supplier_id')
        ->map(function ($grupo) {
          return [
            'fornecedor' => $grupo->first()->supplier->nome,
            'qtdCompras' => $grupo->count(),
            'valorTotal' => $grupo->sum('totalPagar')
          ];
        });

      return response()->json([
        'success' => true,
        'data' => [
          'totais' => $totais,
          'porFornecedor' => $porFornecedor
        ]
      ]);
    } catch (QueryException $e) {
      Log::error('Erro ao gerar relatório de compras: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Erro ao gerar relatório de compras'
      ], 500);
    }
  }
}
