<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentFormRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }


  public function rules(): array
  {

    if ($this->route('payment_form')) {
      $createOrUpdate = [
        'formaPagamento' => "unique:payment_forms,formaPagamento," . $this->route('payment_form')->id
      ];
    } else {
      $createOrUpdate = [
        'formaPagamento' => "unique:payment_forms,formaPagamento"
      ];
    }

    // dd($this);

    return [
      'formaPagamento' => ['required', $createOrUpdate['formaPagamento'], 'max:50'],
      'ativo' => ['required', 'boolean'],
    ];
  }

  public function prepareForValidation()
  {
    $this->merge([
      'formaPagamento' => strtoupper($this->formaPagamento),
    ]);
  }
}
