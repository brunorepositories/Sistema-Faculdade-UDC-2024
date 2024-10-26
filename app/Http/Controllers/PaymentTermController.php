<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FormatData;
use App\Http\Requests\PaymentTermRequest;
use App\Models\Installment;
use App\Models\PaymentForm;
use App\Models\PaymentTerm;
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
    $paymentTerms = $payments->paginate(10);

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

  /**
   * Store a newly created resource in storage.
   */
  // public function store(PaymentTermRequest $request)
  // {
  //   try {
  //     DB::transaction(function () use ($request) {
  //       // Converte todos os campos para uppercase que são strings
  //       // (Supondo que você tenha lógica para converter os campos para uppercase aqui)

  //       $paymentTermObj = PaymentTerm::create($request->all());

  //       foreach ($paymentTermObj->qtdParcelas as $parcela) { // Use [] ao invés de -> para acessar array
  //         Installment::create([
  //           'payment_term_id' => $paymentTermObj->id, // Certifique-se de que esse ID está correto
  //           'payment_form_id' => $parcela['payment_form_id'],
  //           'parcela' => $parcela['parcela'],
  //           'dias' => $parcela['dias'],
  //           'percentual' => $parcela['percentual'],
  //         ]);
  //       }
  //     });

  //     return to_route('payment_term.index')->with('success', "Condição de Pagamento cadastrada com sucesso.");
  //   } catch (QueryException $th) {
  //     Log::debug('Warning - Erro ao executar query >>> ' . $th); // Corrigido para usar $th

  //     return to_route('payment_term.index')->with('failed', 'Ops, algo deu errado, tente novamente.');
  //   }
  // }

  public function store(PaymentTermRequest $request)
  {

    // dd($request->all());
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
            'parcela' => $parcela['num'],
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
    return view('content.payment_term.show', compact('payment_term'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(PaymentTerm $payment_term)
  {
    return view('content.payment_term.edit', compact('payment_term'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(PaymentTermRequest $request, PaymentTerm $payment_term)
  {
    $payment_term->condicao_pagamento = $request->get('condicao_pagamento');
    $payment_term->multa = $request->get('multa');
    $payment_term->juros = $request->get('juros');
    $payment_term->desconto = $request->get('desconto');
    $payment_term->qtd_parcelas = $request->get('qtd_parcelas');

    $payment_term->save();

    return to_route('payment_term.index')->with('success', 'Condição de Pagamento atualizado com sucesso.');
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
