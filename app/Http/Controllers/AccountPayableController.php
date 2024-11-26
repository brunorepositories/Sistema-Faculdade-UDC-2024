<?php

namespace App\Http\Controllers;


use App\Models\AccountPayable;
use App\Models\PaymentForm;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AccountPayableController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request, AccountPayable $accountPayable)
  {
    $query = $accountPayable->with(['supplier', 'paymentForm'])
      ->orderBy('dataVencimento', 'asc');

    // Filtro por número da nota
    if ($request->filled('search')) {
      $query->where('numeroNota', 'like', '%' . $request->search . '%');
    }

    // Filtro por status
    if ($request->filled('status')) {
      $query->where('status', $request->status);
    }

    // Filtro por período
    if ($request->filled('data_inicio')) {
      $query->where('dataVencimento', '>=', $request->data_inicio);
    }

    if ($request->filled('data_fim')) {
      $query->where('dataVencimento', '<=', $request->data_fim);
    }

    $accountPayables = $query->paginate(10);

    return view('content.account_payable.index', compact('accountPayables'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $paymentForms = PaymentForm::where('ativo', true)->orderBy('nome')->get();
    return view('content.account_payable.create', compact('paymentForms'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      DB::transaction(function () use ($request) {
        AccountPayable::create($request->all());
      });




      // CONVERTER OS VALORES COM O REQUEST





      return to_route('account_payable.index')->with('success', "Conta a pagar cadastrada com sucesso.");
    } catch (QueryException $ex) {
      Log::error('Erro ao cadastrar conta a pagar >>> ' . $ex->getMessage());
      return to_route('account_payable.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(AccountPayable $accountPayable)
  {
    $paymentForms = PaymentForm::where('ativo', true)->orderBy('nome')->get();
    return view('content.account_payable.edit', compact('accountPayable', 'paymentForms'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, AccountPayable $accountPayable)
  {
    try {
      if ($accountPayable->status !== 'pendente') {
        return back()->with('failed', 'Apenas contas pendentes podem ser editadas.');
      }

      DB::transaction(function () use ($request, $accountPayable) {
        $accountPayable->update($request->all());
      });

      return to_route('account_payable.index')->with('success', "Conta a pagar atualizada com sucesso.");
    } catch (QueryException $ex) {
      Log::error('Erro ao atualizar conta a pagar >>> ' . $ex->getMessage());
      return to_route('account_payable.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Registra o pagamento de uma conta.
   */
  public function pay(Request $request, AccountPayable $id)
  {
    try {
      if ($id->status !== 'pendente') {
        return back()->with('failed', 'Esta conta não está pendente para pagamento.');
      }

      DB::transaction(function () use ($request, $id) {
        $id->update([
          'valorPago' => $request->valorPago,
          'dataPagamento' => $request->dataPagamento,
          'juros' => $request->juros ?? 0,
          'multa' => $request->multa ?? 0,
          'desconto' => $request->desconto ?? 0,
          'status' => 'pago'
        ]);
      });

      return to_route('account_payable.index')->with('success', "Pagamento registrado com sucesso.");
    } catch (QueryException $ex) {
      Log::error('Erro ao registrar pagamento >>> ' . $ex->getMessage());
      return to_route('account_payable.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Cancela uma conta a pagar.
   */
  public function cancel(Request $request, AccountPayable $id)
  {
    try {
      if ($id->status !== 'pendente') {
        return back()->with('failed', 'Apenas contas pendentes podem ser canceladas.');
      }

      DB::transaction(function () use ($request, $id) {
        $id->update([
          'dataCancelamento' => $request->dataCancelamento,
          'status' => 'cancelado'
        ]);
      });

      return to_route('account_payable.index')->with('success', "Conta cancelada com sucesso.");
    } catch (QueryException $ex) {
      Log::error('Erro ao cancelar conta >>> ' . $ex->getMessage());
      return to_route('account_payable.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }

  /**
   * Exporta relatório de contas a pagar.
   */
  public function export(Request $request)
  {
    try {
      $query = AccountPayable::with(['supplier', 'paymentForm']);

      // Aplica os mesmos filtros da listagem
      if ($request->filled('search')) {
        $query->where('numeroNota', 'like', '%' . $request->search . '%');
      }

      if ($request->filled('status')) {
        $query->where('status', $request->status);
      }

      if ($request->filled('data_inicio')) {
        $query->where('dataVencimento', '>=', $request->data_inicio);
      }

      if ($request->filled('data_fim')) {
        $query->where('dataVencimento', '<=', $request->data_fim);
      }

      $accountPayables = $query->get();

      // Lógica de exportação aqui
      // Retornar arquivo Excel/PDF conforme necessidade

      return back()->with('success', "Relatório exportado com sucesso.");
    } catch (\Exception $ex) {
      Log::error('Erro ao exportar relatório >>> ' . $ex->getMessage());
      return back()->with('failed', 'Ops, algo deu errado ao exportar o relatório.');
    }
  }
}
