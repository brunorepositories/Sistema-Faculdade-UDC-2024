<?php

namespace App\Http\Controllers;

use App\Models\AccountReceivable;
use App\Models\Sale;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AccountReceivableController extends Controller
{
  protected function formatDecimalValue($value)
  {
    if (is_null($value)) {
      return null;
    }

    $value = preg_replace('/[^\d.,]/', '', $value);
    $value = str_replace(',', '.', $value);
    $value = preg_replace('/\.(?=.*\.)/', '', $value);

    return $value ? (float) $value : null;
  }

  /**
   * Lista recebimentos
   */
  public function index(Request $request)
  {
    try {
      $query = AccountReceivable::query()
        ->with(['customer', 'paymentForm']);

      // Filtros
      if ($request->status) {
        $query->where('status', $request->status);
      }

      if ($request->vencimento_inicio) {
        $query->whereDate('dataVencimento', '>=', $request->vencimento_inicio);
      }

      if ($request->vencimento_fim) {
        $query->whereDate('dataVencimento', '<=', $request->vencimento_fim);
      }

      if ($request->customer_id) {
        $query->where('customer_id', $request->customer_id);
      }

      // Ordenação
      $query->orderBy($request->sort_by ?? 'dataVencimento', $request->sort_order ?? 'asc');

      $receivables = $query->paginate($request->per_page ?? 10);

      return view('content.account_receivable.index', compact('receivables'));
    } catch (QueryException $e) {
      Log::error('Erro ao listar recebimentos: ' . $e->getMessage());
      return back()->with('error', 'Erro ao carregar recebimentos');
    }
  }

  /**
   * Registra recebimento de parcela
   */
  public function receive(Request $request, AccountReceivable $receivable)
  {
    try {
      DB::transaction(function () use ($request, $receivable) {
        $valorPago = $this->formatDecimalValue($request->valorPago);
        $juros = $this->formatDecimalValue($request->juros);
        $multa = $this->formatDecimalValue($request->multa);
        $desconto = $this->formatDecimalValue($request->desconto);

        $receivable->update([
          'valorPago' => $valorPago,
          'juros' => $juros,
          'multa' => $multa,
          'desconto' => $desconto,
          'dataPagamento' => now(),
          'status' => 'pago',
          'observacao' => $request->observacao
        ]);
      });

      return to_route('account_receivable.index')->with('success', "Conta recebida com sucesso.");
    } catch (QueryException $ex) {
      Log::error('Erro ao cancelar conta >>> ' . $ex->getMessage());
      return to_route('account_receivable.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Cancela recebimento
   */
  public function cancel(AccountReceivable $receivable)
  {
    try {
      if ($receivable->status === 'pago') {
        return back()->with('error', 'Não é possível cancelar um recebimento já efetivado');
      }

      $receivable->update([
        'status' => 'cancelado',
        'dataCancelamento' => now()
      ]);

      return to_route('account_receivable.index')->with('success', "Conta cancelada com sucesso.");
    } catch (QueryException $ex) {
      Log::error('Erro ao cancelar conta >>> ' . $ex->getMessage());
      return to_route('account_receivable.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Gera relatório de recebimentos
   */
  public function report(Request $request)
  {
    try {
      $query = AccountReceivable::query()
        ->with(['customer', 'paymentForm']);

      if ($request->data_inicio) {
        $query->whereDate('dataVencimento', '>=', $request->data_inicio);
      }

      if ($request->data_fim) {
        $query->whereDate('dataVencimento', '<=', $request->data_fim);
      }

      $recebimentos = $query->get();

      $totais = [
        'total' => $recebimentos->sum('valorParcela'),
        'recebido' => $recebimentos->where('status', 'pago')->sum('valorPago'),
        'pendente' => $recebimentos->where('status', 'pendente')->sum('valorParcela'),
        'cancelado' => $recebimentos->where('status', 'cancelado')->sum('valorParcela'),
        'juros' => $recebimentos->sum('juros'),
        'multa' => $recebimentos->sum('multa'),
        'desconto' => $recebimentos->sum('desconto')
      ];

      $porCliente = $recebimentos->groupBy('customer_id')
        ->map(function ($grupo) {
          return [
            'cliente' => $grupo->first()->customer->nome,
            'total' => $grupo->sum('valorParcela'),
            'recebido' => $grupo->where('status', 'pago')->sum('valorPago'),
            'pendente' => $grupo->where('status', 'pendente')->sum('valorParcela')
          ];
        });

      return view('content.account_receivable.report', compact('totais', 'porCliente'));
    } catch (QueryException $e) {
      Log::error('Erro ao gerar relatório: ' . $e->getMessage());
      return back()->with('error', 'Erro ao gerar relatório');
    }
  }
}
