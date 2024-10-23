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
  public function index(PaymentForm $payments)
  {
    // $searchTerm = $request->input('search') ?? '';
    $paymentForms = $payments->paginate(10);

    return view('content.payment_form.index', compact('paymentForms'));
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
  public function show(PaymentForm $paymentForm)
  {
    return view('content.payment_form.show', compact('payment_form'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(PaymentForm $paymentForm)
  {
    return view('content.payment_form.edit', compact('paymentForm'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(PaymentFormRequest $request, PaymentForm $paymentForm)
  {

    $paymentForm->update($request->all());

    return to_route('payment_form.index')->with('success', 'Forma de Pagamento atualizado com sucesso.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(PaymentForm $paymentForm)
  {
    $paymentForm->delete();

    return to_route('payment_form.index')->with('success', 'Forma de Pagamento excluído com sucesso.');
  }

  public function buscar(Request $request)
  {
    $paymentForm = $request->input('search') ?? '';
    $paymentForm = PaymentForm::search($paymentForm)->paginate(10);

    return response()->json($paymentForm);
  }
}
