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

    if ($this->route('payment_term')) {
      $createOrUpdate = [
        'condicaoPagamento' => "unique:payment_term,condicaoPagamento," . $this->route('payment_term')->id,
      ];
    } else {
      $createOrUpdate = [
        'condicaoPagamento' => "unique:payment_term,condicaoPagamento",
      ];
    }

    return [
      'condicaoPagamento' => ['required', $createOrUpdate['nome'], 'max:100'],
      'multa' => ['required', $createOrUpdate['uf'], 'min:0'],
      'juro' => ['required', $createOrUpdate['uf'], 'min:0'],
      'desconto' => ['required', $createOrUpdate['uf'], 'min:0', 'max:100'],
      'parcelas' => new CheckArray
    ];
  }

  // public function messages(): array
  // {
  //   return [
  //     'country_id.required' => 'Selecione um país para prosseguir.',
  //     'country_id.exists' => 'O país selecionado não é válido.',
  //   ];
  // }
}
