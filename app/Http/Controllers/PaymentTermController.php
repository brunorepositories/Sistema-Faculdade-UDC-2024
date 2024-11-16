<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormatData;
use App\Http\Requests\PaymentTermRequest;
use App\Models\Installment;
use App\Models\PaymentForm;
use App\Models\PaymentTerm;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentTermController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(PaymentTerm $payments)
  {
    // $searchTerm = $request->input('search') ?? '';
    $paymentTerms = $payments->orderBy('updated_at', 'desc')->paginate(10);

    return view('content.payment_term.index', compact('paymentTerms'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {

    $paymentForms = PaymentForm::all();

    return view('content.payment_term.create', compact('paymentForms'));
  }

  public function store(PaymentTermRequest $request)
  {
    try {
      DB::transaction(function () use ($request) {

        $paymentTermObj = $request->only([
          'condicaoPagamento',
          'multa',
          'juros',
          'desconto'
        ]);

        // Adiciona 'qtdParcelas' ao array $paymentTermObj
        $paymentTermObj['qtdParcelas'] = count($request->parcelas);

        // Cria a condição de pagamento
        $paymentTerm = PaymentTerm::create($paymentTermObj);

        // dd($request->parcelas);

        // Itera sobre as parcelas recebidas do request
        foreach ($request->parcelas as $parcela) {
          Installment::create([
            'payment_term_id' => $paymentTerm->id,
            'payment_form_id' => $parcela['payment_form_id'],
            'parcela' => $parcela['parcela'],
            'dias' => $parcela['dias'],  // Alterado de `multa` para `dias`
            'percentual' => $parcela['percentual'],
          ]);
        }
      });

      return to_route('payment_term.index')->with('success', "Condição de Pagamento cadastrada com sucesso.");
    } catch (QueryException $th) {
      Log::error('Erro ao cadastrar condição de pagamento: ' . $th->getMessage());

      return to_route('payment_term.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
    }
  }


  /**
   * Display the specified resource.
   */
  public function show(PaymentTerm $payment_term)
  {
    return view('content.payment_term.show', compact('paymentTerm'));
  }


  public function edit(PaymentTerm $paymentTerm)
  {
    try {

      $paymentTerm = PaymentTerm::with('installments')->findOrFail($paymentTerm->id);

      // dd($paymentTerm);

      // Busca todas as formas de pagamento ativas para o select
      $paymentForms = PaymentForm::where('ativo', true)
        ->orderBy('id')
        ->get();


      return view('content.payment_term.edit', compact('paymentTerm', 'paymentForms'));
    } catch (QueryException $th) {
      Log::error('Erro ao carregar condição de pagamento para edição: ' . $th->getMessage());
      return to_route('payment_term.index')
        ->with('failed', 'Ops, algo deu errado ao carregar os dados para edição, tente novamente.');
    }
  }

  /**
   * Função de atualização (update)
   */
  public function update(PaymentTermRequest $request, PaymentTerm $paymentTerm)
  {
    try {
      DB::transaction(function () use ($request, $paymentTerm) {
        // Atualiza os campos principais da condição de pagamento
        $paymentTermObj = $request->only([
          'condicaoPagamento',
          'multa',
          'juros',
          'desconto',
          'ativo'
        ]);

        // Atualiza a quantidade de parcelas com base na entrada
        $paymentTermObj['qtdParcelas'] = count($request->parcelas);

        // Salva as alterações na condição de pagamento
        $paymentTerm->update($paymentTermObj);

        // Limpa as parcelas antigas associadas a essa condição de pagamento
        $paymentTerm->installments()->delete();

        // Cria as novas parcelas
        foreach ($request->parcelas as $parcela) {
          // Aqui garantimos que os dados são passados corretamente para criar uma nova parcela
          Installment::create([
            'payment_term_id' => $paymentTerm->id, // Associando a parcela à condição de pagamento
            'payment_form_id' => $parcela['payment_form_id'], // Forma de pagamento da parcela
            'parcela' => $parcela['parcela'], // Número da parcela
            'dias' => $parcela['dias'], // Número de dias para o vencimento da parcela
            'percentual' => $parcela['percentual'], // Percentual da parcela
          ]);
        }
      });

      // Retorna a resposta de sucesso
      return to_route('payment_term.index')->with('success', "Condição de pagamento atualizada com sucesso.");
    } catch (QueryException $th) {
      // Em caso de erro, loga o erro e retorna uma resposta de falha
      Log::error('Erro ao atualizar condição de pagamento: ' . $th->getMessage());

      return to_route('payment_term.index')->with('failed', 'Ops, algo deu errado. Tente novamente.');
    }
  }



  /**
   * Remove the specified resource from storage.
   */
  public function destroy(PaymentTerm $payment_term)
  {
    $payment_term->delete();

    return to_route('payment_term.index')->with('success', 'Condição de Pagamento excluído com sucesso.');
  }

  public function buscar(Request $request)
  {
    $payment_term = $request->input('search') ?? '';
    $payment_term = PaymentTerm::search($payment_term)->paginate(10);

    return response()->json($payment_term);
  }
}
