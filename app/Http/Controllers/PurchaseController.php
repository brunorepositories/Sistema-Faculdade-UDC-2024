<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\AccountPayable;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PaymentTerm;
use App\Models\Product;
use App\Models\PurchaseProducts;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{

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

  private function calcularRateio($produtos, $valorFrete, $valorSeguro, $outrasDespesas)
  {
    $totalDespesas = $valorFrete + $valorSeguro + $outrasDespesas;

    if ($totalDespesas <= 0) {
      return array_fill_keys(array_keys($produtos), 0);
    }

    // Calcula o valor total já considerando descontos
    $valorTotalCompra = array_reduce($produtos, function ($total, $produto) {
      $valorComDesconto = $produto['precoProduto'] * (1 - ($produto['descontoProduto'] ?? 0) / 100);
      return $total + ($valorComDesconto * $produto['qtdProduto']);
    }, 0);

    $rateios = [];
    foreach ($produtos as $id => $produto) {
      $valorComDesconto = $produto['precoProduto'] * (1 - ($produto['descontoProduto'] ?? 0) / 100);
      $valorProduto = $valorComDesconto * $produto['qtdProduto'];
      $percentual = $valorProduto / $valorTotalCompra;
      $rateios[$id] = round($totalDespesas * $percentual, 2);
    }

    return $rateios;
  }

  private function calcularCustoMedio($produto_id, $qtdNova, $custoNovo, $valorRateio = 0, $desconto = 0)
  {
    $produto = Product::find($produto_id);

    // Aplica o desconto ao custo
    $custoComDesconto = $custoNovo * (1 - ($desconto / 100));

    // Custo unitário considerando o rateio
    $custoUnitarioTotal = $custoComDesconto + ($valorRateio / $qtdNova);

    // Cálculo do custo médio ponderado
    $valorEstoqueAtual = $produto->estoque * ($produto->custoMedio ?? 0);
    $valorNovaCompra = $qtdNova * $custoUnitarioTotal;

    $novaQuantidadeTotal = $produto->estoque + $qtdNova;

    if ($novaQuantidadeTotal == 0) {
      return $custoUnitarioTotal;
    }

    return round(($valorEstoqueAtual + $valorNovaCompra) / $novaQuantidadeTotal, 2);
  }


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

  protected function formatPurchaseData($data)
  {
    // Formata valores monetários
    $data['valorFrete'] = $this->formatDecimalValue($data['valorFrete']);
    $data['valorSeguro'] = $this->formatDecimalValue($data['valorSeguro']);
    $data['outrasDespesas'] = $this->formatDecimalValue($data['outrasDespesas']);
    $data['totalProdutos'] = $this->formatDecimalValue($data['totalProdutos']);
    $data['totalPagar'] = $this->formatDecimalValue($data['totalPagar']);

    // Formata produtos
    if (isset($data['produtos']) && is_array($data['produtos'])) {
      foreach ($data['produtos'] as $key => $produto) {
        $data['produtos'][$key]['precoProduto'] = $this->formatDecimalValue($produto['precoProduto']);
        $data['produtos'][$key]['descontoProduto'] = $this->formatDecimalValue($produto['descontoProduto'] ?? 0);
        $data['produtos'][$key]['qtdProduto'] = $this->formatDecimalValue($produto['qtdProduto']);
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

  public function store(PurchaseRequest $request)
  {
    try {
      // Formata os dados antes de prosseguir
      $formattedData = $this->formatPurchaseData($request->all());

      DB::transaction(function () use ($formattedData) {
        // Dados da compra
        $purchaseData = collect($formattedData)->only([
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
        ])->toArray();

        // Criação da compra
        $purchase = Purchase::create($purchaseData);

        // Prepara dados para cálculo do rateio
        $produtosParaRateio = [];
        foreach ($formattedData['produtos'] as $product) {
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
        foreach ($formattedData['produtos'] as $productData) {
          $product_id = $productData['product_id'];
          $valorRateio = $rateios[$product_id] ?? 0;

          // Calcula o novo custo médio
          $custoMedio = $this->calcularCustoMedio(
            $product_id,
            $productData['qtdProduto'],
            $productData['precoProduto'],
            $valorRateio,
            $productData['descontoProduto'] ?? 0  // Passa o desconto
          );

          // Custo unitário com rateio
          // Custo unitário com rateio (também considerando desconto)
          $custoUltCompra = ($productData['precoProduto'] * (1 - ($productData['descontoProduto'] ?? 0) / 100))
            + ($valorRateio / $productData['qtdProduto']);


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
            'estoque' => DB::raw("estoque + {$productData['qtdProduto']}"),
            'dtUltimaCompra' => $purchase->dataChegada,
          ]);
        }

        // Processa as parcelas
        if (isset($formattedData['parcelas']) && !empty($formattedData['parcelas'])) {
          foreach ($formattedData['parcelas'] as $parcela) {
            AccountPayable::create([
              'numeroNota' => $purchase->numeroNota,
              'modelo' => $purchase->modelo,
              'serie' => $purchase->serie,
              'supplier_id' => $purchase->supplier_id,
              'parcela' => $parcela['parcela'],
              'valorParcela' => $parcela['valor'],
              'valorPago' => null,
              'juros' => null,
              'multa' => null,
              'desconto' => null,
              'dataVencimento' => $parcela['dataVencimento'],
              'dataPagamento' => null,
              'dataCancelamento' => null,
              'payment_form_id' => $parcela['payment_form_id'],
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

  public function show($numeroNota, $modelo, $serie, $supplier_id)
  {
    try {
      // Busca a compra com todas as relações necessárias
      $purchase = Purchase::where([
        'numeroNota' => $numeroNota,
        'modelo' => $modelo,
        'serie' => $serie,
        'supplier_id' => $supplier_id
      ])->with([
        // Produtos e suas relações
        'products' => function ($query) {
          $query->withPivot([
            'precoProduto',
            'qtdProduto',
            'descontoProduto',
            'custoMedio',
            'custoUltCompra',
            'rateio'
          ]);
        },
        'products.measure',

        // Fornecedor e suas relações
        'supplier.city',

        // Condição de pagamento
        'paymentTerm',

        // Contas a pagar
        'accountPayables' => function ($query) {
          $query->orderBy('parcela', 'asc');
        },
        'accountPayables.paymentForm'
      ])->firstOrFail();

      // Calcula totais dos produtos
      $totals = [
        'totalQuantidade' => $purchase->products->sum('pivot.qtdProduto'),
        'totalProdutosSemDesconto' => $purchase->products->sum(function ($product) {
          return $product->pivot->precoProduto * $product->pivot->qtdProduto;
        }),
        'totalDesconto' => $purchase->products->sum(function ($product) {
          $subtotal = $product->pivot->precoProduto * $product->pivot->qtdProduto;
          $desconto = $product->pivot->descontoProduto ?? 0;
          return ($subtotal * $desconto) / 100;
        }),
        'totalRateio' => $purchase->products->sum('pivot.rateio'),
      ];

      // Prepara dados do fornecedor
      $fornecedorDetalhes = [
        'documento' => $purchase->supplier->tipoPessoa === 'F' ? 'CPF' : 'CNPJ',
        'numeroDocumento' => $purchase->supplier->cpfCnpj,
        'telefone' => $purchase->supplier->celular ?? $purchase->supplier->telefone,
        'endereco' => sprintf(
          "%s, %s, %s - %s/%s",
          $purchase->supplier->endereco,
          $purchase->supplier->numero,
          $purchase->supplier->bairro,
          $purchase->supplier->city->nome,
          $purchase->supplier->city->estado
        )
      ];

      // Calcula status de pagamento
      $statusPagamento = $this->calcularStatusPagamento($purchase->accountPayables);

      // Calcula estatísticas das parcelas
      $statusParcelas = $this->calcularStatusParcelas($purchase->accountPayables);

      return view('purchase.show', compact(
        'purchase',
        'totals',
        'fornecedorDetalhes',
        'statusPagamento',
        'statusParcelas'
      ));
    } catch (ModelNotFoundException $e) {
      Log::error('Nota fiscal não encontrada: ' . $e->getMessage());
      return to_route('purchase.index')
        ->with('error', 'Nota fiscal não encontrada.');
    } catch (\Exception $e) {
      Log::error('Erro ao visualizar nota fiscal: ' . $e->getMessage());
      return to_route('purchase.index')
        ->with('error', 'Erro ao carregar dados da nota fiscal.');
    }
  }

  /**
   * Calcula o status geral do pagamento
   */
  private function calcularStatusPagamento($parcelas)
  {
    $hoje = now();
    $totalParcelas = $parcelas->count();
    $parcelasPagas = $parcelas->where('status', 'Pago')->count();
    $parcelasVencidas = $parcelas
      ->where('status', 'pendente')
      ->where('dataVencimento', '<', $hoje)
      ->count();

    if ($parcelasPagas === $totalParcelas) {
      return [
        'status' => 'Pago',
        'classe' => 'success',
        'descricao' => 'Nota fiscal totalmente paga'
      ];
    } elseif ($parcelasVencidas > 0) {
      return [
        'status' => 'Atrasado',
        'classe' => 'danger',
        'descricao' => "Existem $parcelasVencidas parcela(s) vencida(s)"
      ];
    }

    return [
      'status' => 'Pendente',
      'classe' => 'warning',
      'descricao' => 'Existem parcelas a vencer'
    ];
  }

  /**
   * Calcula estatísticas das parcelas
   */
  private function calcularStatusParcelas($parcelas)
  {
    $hoje = now();

    return [
      'total' => $parcelas->count(),
      'pagas' => $parcelas->where('status', 'Pago')->count(),
      'pendentes' => $parcelas->where('status', 'pendente')->count(),
      'vencidas' => $parcelas
        ->where('status', 'pendente')
        ->where('dataVencimento', '<', $hoje)
        ->count(),
      'totalPago' => $parcelas
        ->where('status', 'Pago')
        ->sum('valorPago'),
      'totalRestante' => $parcelas
        ->where('status', 'pendente')
        ->sum('valorParcela'),
    ];
  }

  /**
   * Obtém estatísticas das parcelas
   */
  private function getStatusParcelas($parcelas)
  {
    $hoje = now();

    return [
      'total' => $parcelas->count(),
      'pagas' => $parcelas->where('status', 'Pago')->count(),
      'pendentes' => $parcelas->where('status', 'Pendente')->count(),
      'vencidas' => $parcelas
        ->where('status', 'Pendente')
        ->where('dataVencimento', '<', $hoje)
        ->count(),
      'totalPago' => $parcelas->sum('valorPago'),
      'totalRestante' => $parcelas
        ->where('status', 'Pendente')
        ->sum('valorParcela'),
    ];
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
