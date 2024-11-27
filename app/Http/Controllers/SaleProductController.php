<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProducts;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleProductController extends Controller
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

  /**
   * Retorna produtos de uma venda específica
   */
  public function index(Sale $sale)
  {
    try {
      $products = SaleProducts::where([
        'numeroNota' => $sale->numeroNota,
        'modelo' => $sale->modelo,
        'serie' => $sale->serie,
        'customer_id' => $sale->customer_id
      ])
        ->with(['product.measure'])
        ->get();

      return response()->json([
        'success' => true,
        'data' => $products
      ]);
    } catch (QueryException $e) {
      Log::error('Erro ao buscar produtos da venda: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Erro ao buscar produtos da venda'
      ], 500);
    }
  }

  /**
   * Verifica disponibilidade de estoque
   */
  public function checkStock(Request $request)
  {
    try {
      $product = Product::findOrFail($request->product_id);
      $quantidade = $this->formatDecimalValue($request->quantidade);

      $disponivel = $product->estoque >= $quantidade;
      $estoqueAtual = $product->estoque;

      return response()->json([
        'success' => true,
        'disponivel' => $disponivel,
        'estoque' => $estoqueAtual,
        'message' => $disponivel ?
          'Estoque disponível' :
          "Estoque insuficiente. Disponível: {$estoqueAtual}"
      ]);
    } catch (QueryException $e) {
      Log::error('Erro ao verificar estoque: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Erro ao verificar estoque'
      ], 500);
    }
  }

  /**
   * Calcula valores do produto com desconto e acréscimo
   */
  public function calculate(Request $request)
  {
    try {
      $quantidade = $this->formatDecimalValue($request->quantidade);
      $precoVenda = $this->formatDecimalValue($request->precoVenda);
      $desconto = $this->formatDecimalValue($request->desconto ?? 0);
      $acrescimo = $this->formatDecimalValue($request->acrescimo ?? 0);
      $percentualComissao = $this->formatDecimalValue($request->percentualComissao ?? 0);

      // Cálculo do valor do produto
      $subtotal = $quantidade * $precoVenda;
      $valorDesconto = ($subtotal * $desconto) / 100;
      $valorAcrescimo = ($subtotal * $acrescimo) / 100;
      $valorComDescontoEAcrescimo = $subtotal - $valorDesconto + $valorAcrescimo;

      // Se houver produto, calcula comissão
      $valorComissao = 0;
      if ($request->product_id) {
        $product = Product::find($request->product_id);
        if ($product) {
          $lucroUnitario = $precoVenda - $product->custoMedio;
          $valorComissao = ($lucroUnitario * $quantidade * $percentualComissao) / 100;
        }
      }

      return response()->json([
        'success' => true,
        'data' => [
          'subtotal' => round($subtotal, 2),
          'valorDesconto' => round($valorDesconto, 2),
          'valorAcrescimo' => round($valorAcrescimo, 2),
          'valorComissao' => round($valorComissao, 2),
          'total' => round($valorComDescontoEAcrescimo, 2),
          'lucroEstimado' => round($valorComDescontoEAcrescimo - ($product->custoMedio * $quantidade ?? 0), 2)
        ]
      ]);
    } catch (\Exception $e) {
      Log::error('Erro ao calcular valores: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Erro ao calcular valores do produto'
      ], 500);
    }
  }

  /**
   * Lista histórico de vendas do produto
   */
  public function saleHistory(Product $product)
  {
    try {
      $history = SaleProducts::where('product_id', $product->id)
        ->with(['sale' => function ($query) {
          $query->whereNull('dataCancelamento');
        }])
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($item) {
          return [
            'data' => $item->created_at->format('d/m/Y'),
            'nota' => "{$item->numeroNota}-{$item->modelo}-{$item->serie}",
            'quantidade' => $item->qtdProduto,
            'preco' => $item->precoVenda,
            'desconto' => $item->descontoProduto,
            'acrescimo' => $item->acrescimoProduto,
            'custoMedio' => $item->custoMedio,
            'precoUltVenda' => $item->precoUltVenda,
            'valorComissao' => $item->valorComissao
          ];
        });

      return response()->json([
        'success' => true,
        'data' => $history
      ]);
    } catch (QueryException $e) {
      Log::error('Erro ao buscar histórico de vendas: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Erro ao buscar histórico de vendas'
      ], 500);
    }
  }

  /**
   * Dashboard de análise de vendas do produto
   */
  public function dashboard(Product $product)
  {
    try {
      $now = now();
      $sixMonthsAgo = $now->copy()->subMonths(6);

      // Histórico de vendas
      $vendasHistorico = SaleProducts::where('product_id', $product->id)
        ->whereHas('sale', function ($query) use ($sixMonthsAgo) {
          $query->whereNull('dataCancelamento')
            ->where('dataSaida', '>=', $sixMonthsAgo);
        })
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(function ($item) {
          return [
            'data' => $item->created_at->format('m/Y'),
            'precoVenda' => $item->precoVenda,
            'custoMedio' => $item->custoMedio,
            'lucro' => $item->precoVenda - $item->custoMedio
          ];
        });

      // Totais do período
      $totais = SaleProducts::where('product_id', $product->id)
        ->whereHas('sale', function ($query) use ($sixMonthsAgo) {
          $query->whereNull('dataCancelamento')
            ->where('dataSaida', '>=', $sixMonthsAgo);
        })
        ->get();

      // Cálculo de lucratividade
      $analise = [
        'totalVendas' => $totais->count(),
        'quantidadeTotal' => $totais->sum('qtdProduto'),
        'valorTotal' => $totais->sum(function ($item) {
          return $item->precoVenda * $item->qtdProduto;
        }),
        'lucroTotal' => $totais->sum(function ($item) {
          return ($item->precoVenda - $item->custoMedio) * $item->qtdProduto;
        }),
        'comissaoTotal' => $totais->sum('valorComissao'),
        'ticketMedio' => $totais->count() > 0 ?
          $totais->sum(function ($item) {
            return $item->precoVenda * $item->qtdProduto;
          }) / $totais->count() : 0,
        'margemMediaLucro' => $totais->avg(function ($item) {
          return (($item->precoVenda - $item->custoMedio) / $item->precoVenda) * 100;
        }),
        'ultimaVenda' => [
          'data' => $product->dtUltimaVenda,
          'preco' => $product->precoUltimaVenda
        ]
      ];

      // Análise por períodos
      $analisePeriodicaVendas = $totais->groupBy(function ($item) {
        return $item->created_at->format('m/Y');
      })->map(function ($grupo) {
        return [
          'quantidade' => $grupo->sum('qtdProduto'),
          'valor' => $grupo->sum(function ($item) {
            return $item->precoVenda * $item->qtdProduto;
          }),
          'lucro' => $grupo->sum(function ($item) {
            return ($item->precoVenda - $item->custoMedio) * $item->qtdProduto;
          })
        ];
      });

      return view('sale-products.dashboard', compact(
        'product',
        'vendasHistorico',
        'analise',
        'analisePeriodicaVendas'
      ));
    } catch (\Exception $e) {
      Log::error('Erro ao carregar dashboard: ' . $e->getMessage());
      return back()->with('error', 'Erro ao carregar análises do produto');
    }
  }

  /**
   * Análise de rentabilidade do produto
   */
  public function profitability(Product $product)
  {
    try {
      $now = now();
      $startOfYear = $now->copy()->startOfYear();

      $vendas = SaleProducts::where('product_id', $product->id)
        ->whereHas('sale', function ($query) use ($startOfYear) {
          $query->whereNull('dataCancelamento')
            ->where('dataSaida', '>=', $startOfYear);
        })
        ->get();

      $analise = [
        'volumeVendas' => [
          'quantidade' => $vendas->sum('qtdProduto'),
          'valor' => $vendas->sum(function ($item) {
            return $item->precoVenda * $item->qtdProduto;
          })
        ],
        'margens' => [
          'mediaLucro' => $vendas->avg(function ($item) {
            return (($item->precoVenda - $item->custoMedio) / $item->precoVenda) * 100;
          }),
          'mediaDesconto' => $vendas->avg('descontoProduto'),
          'mediaAcrescimo' => $vendas->avg('acrescimoProduto')
        ],
        'custos' => [
          'medio' => $vendas->avg('custoMedio'),
          'atual' => $product->custoMedio,
          'variacao' => $product->custoMedio > 0 ?
            (($vendas->avg('custoMedio') - $product->custoMedio) / $product->custoMedio) * 100 : 0
        ],
        'comissoes' => [
          'total' => $vendas->sum('valorComissao'),
          'media' => $vendas->avg('percentualComissao')
        ],
        'giroEstoque' => $product->estoque > 0 ?
          $vendas->sum('qtdProduto') / $product->estoque : 0
      ];

      return response()->json([
        'success' => true,
        'data' => $analise
      ]);
    } catch (\Exception $e) {
      Log::error('Erro ao calcular rentabilidade: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Erro ao calcular rentabilidade do produto'
      ], 500);
    }
  }
}
