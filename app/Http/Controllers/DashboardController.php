<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Purchase;
use App\Models\AccountReceivable;
use App\Models\AccountPayable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index(Request $request)
  {
    // Obtém o mês selecionado do formulário ou usa o mês atual como padrão
    $mesSelecionado = $request->get('mes', date('Y-m'));
    $data = Carbon::createFromFormat('Y-m', $mesSelecionado);

    $inicioMes = $data->copy()->startOfMonth();
    $fimMes = $data->copy()->endOfMonth();

    // Total de Vendas do Mês
    $vendasMes = Sale::whereNull('dataCancelamento')
      ->whereBetween('dataEmissao', [$inicioMes, $fimMes])
      ->select([
        DB::raw('COUNT(*) as total_vendas'),
        DB::raw('SUM(sales."totalPagar") as valor_total')
      ])
      ->first();

    // Total de Compras do Mês
    $comprasMes = Purchase::whereNull('dataCancelamento')
      ->whereBetween('dataEmissao', [$inicioMes, $fimMes])
      ->select([
        DB::raw('COUNT(*) as total_compras'),
        DB::raw('SUM(purchases."totalPagar") as valor_total')
      ])
      ->first();

    // Top 10 Produtos do Mês Selecionado com join composto
    $topProdutos = DB::table('sale_products')
      ->join('sales', function ($join) {
        $join->on('sales.numeroNota', '=', 'sale_products.numeroNota')
          ->on('sales.modelo', '=', 'sale_products.modelo')
          ->on('sales.serie', '=', 'sale_products.serie')
          ->on('sales.customer_id', '=', 'sale_products.customer_id');
      })
      ->join('products', 'products.id', '=', 'sale_products.product_id')
      ->whereNull('sales.dataCancelamento')
      ->whereBetween('sales.dataEmissao', [$inicioMes, $fimMes])
      ->select([
        'products.id',
        'products.nome',
        DB::raw('SUM("sale_products"."qtdProduto") as quantidade_vendida'),
        DB::raw('SUM("sale_products"."precoProduto" * "sale_products"."qtdProduto") as valor_total')
      ])
      ->groupBy('products.id', 'products.nome')
      ->orderBy('quantidade_vendida', 'desc')
      ->limit(10)
      ->get();

    // Financeiro Recebimentos
    $financeiroReceber = [
      'a_receber' => AccountReceivable::whereNull('dataCancelamento')
        ->where('status', 'pendente')
        ->where('dataVencimento', '>=', $inicioMes)
        ->sum('valorParcela'),

      'recebido' => AccountReceivable::whereNull('dataCancelamento')
        ->where('status', 'pago')
        ->whereBetween('dataPagamento', [$inicioMes, $fimMes])
        ->sum('valorPago'),

      'vencido' => AccountReceivable::whereNull('dataCancelamento')
        ->where('status', 'pendente')
        ->where('dataVencimento', '<', $inicioMes)
        ->sum('valorParcela')
    ];

    // Financeiro Pagamentos
    $financeiroPagar = [
      'a_pagar' => AccountPayable::whereNull('dataCancelamento')
        ->where('status', 'pendente')
        ->where('dataVencimento', '>=', $inicioMes)
        ->sum('valorParcela'),

      'pago' => AccountPayable::whereNull('dataCancelamento')
        ->where('status', 'pago')
        ->whereBetween('dataPagamento', [$inicioMes, $fimMes])
        ->sum('valorPago'),

      'vencido' => AccountPayable::whereNull('dataCancelamento')
        ->where('status', 'pendente')
        ->where('dataVencimento', '<', $inicioMes)
        ->sum('valorParcela')
    ];

    // Status de Documentos
    $statusVendas = Sale::whereNull('dataCancelamento')
      ->whereBetween('dataEmissao', [$inicioMes, $fimMes])
      ->select('status', DB::raw('count(*) as total'))
      ->groupBy('status')
      ->get()
      ->pluck('total', 'status');

    $statusCompras = Purchase::whereNull('dataCancelamento')
      ->whereBetween('dataEmissao', [$inicioMes, $fimMes])
      ->select('status', DB::raw('count(*) as total'))
      ->groupBy('status')
      ->get()
      ->pluck('total', 'status');

    // Produtos mais comprados com join composto
    $topProdutosComprados = DB::table('purchase_products')
      ->join('purchases', function ($join) {
        $join->on('purchases.numeroNota', '=', 'purchase_products.numeroNota')
          ->on('purchases.modelo', '=', 'purchase_products.modelo')
          ->on('purchases.serie', '=', 'purchase_products.serie')
          ->on('purchases.supplier_id', '=', 'purchase_products.supplier_id');
      })
      ->join('products', 'products.id', '=', 'purchase_products.product_id')
      ->whereNull('purchases.dataCancelamento')
      ->whereBetween('purchases.dataEmissao', [$inicioMes, $fimMes])
      ->select([
        'products.id',
        'products.nome',
        DB::raw('SUM("purchase_products"."qtdProduto") as quantidade_comprada'),
        DB::raw('SUM("purchase_products"."precoProduto" * "purchase_products"."qtdProduto") as valor_total')
      ])
      ->groupBy('products.id', 'products.nome')
      ->orderBy('quantidade_comprada', 'desc')
      ->limit(10)
      ->get();

    return view('content.dashboard.index', compact(
      'vendasMes',
      'comprasMes',
      'topProdutos',
      'topProdutosComprados',
      'financeiroReceber',
      'financeiroPagar',
      'statusVendas',
      'statusCompras',
      'mesSelecionado'
    ));
  }
}
