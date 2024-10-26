<?php

namespace App\Http\Requests;

use App\Rules\CheckArray;
use Illuminate\Foundation\Http\FormRequest;

class PaymentTermRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }


  public function rules(): array
  {

    if ($this->route('payment_terms')) {
      $createOrUpdate = [
        'condicaoPagamento' => "unique:payment_terms,condicaoPagamento," . $this->route('payment_terms')->id,
      ];
    } else {
      $createOrUpdate = [
        'condicaoPagamento' => "unique:payment_terms,condicaoPagamento",
      ];
    }

    return [
      'condicaoPagamento' => ['required', $createOrUpdate['condicaoPagamento'], 'max:100'],
      'multa' => ['required', 'min:0'],
      'juros' => ['required', 'min:0'],
      'desconto' => ['required', 'min:0', 'max:100'],
      'parcelas' => new CheckArray
    ];
  }
}
