<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentFormRequest;
use App\Models\PaymentForm;
use Illuminate\Http\Request;

class PaymentFormController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(PaymentFormRequest $request)
  {
    $searchTerm = $request->input('search') ?? '';
    $payment_form = PaymentForm::search($searchTerm)->paginate(10);

    return view('content.payment_form.index', compact('payment_form'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('content.payment_form.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(PaymentFormRequest $request)
  {

    $paymentForm = PaymentForm::create($request->all());

    return to_route('payment_form.index')->with('success', 'Forma de Pagamento criado com sucesso.');
  }

  /**
   * Display the specified resource.
   */
  public function show(PaymentForm $payment_form)
  {
    return view('content.payment_form.show', compact('payment_form'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(PaymentForm $payment_form)
  {
    return view('content.payment_form.edit', compact('payment_form'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(PaymentFormRequest $request, PaymentForm $payment_form)
  {
    $request->validate([
      'forma_pagamento' => 'required|unique:payment_forms|max:255',
    ]);

    $payment_form->update($request->all());

    return to_route('payment_form.index')->with('success', 'Forma de Pagamento atualizado com sucesso.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(PaymentForm $payment_form)
  {
    $payment_form->delete();

    return to_route('payment_form.index')->with('success', 'Forma de Pagamento excluído com sucesso.');
  }

  public function buscar(Request $request)
  {
    $payment_form = $request->input('search') ?? '';
    $payment_form = PaymentForm::search($payment_form)->paginate(10);

    return response()->json($payment_form);
  }
}
