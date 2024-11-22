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
        'condicaoPagamento' => "unique:payment_terms,condicaoPagamento," . $this->route('payment_term')->id,
      ];
    } else {
      $createOrUpdate = [
        'condicaoPagamento' => "unique:payment_terms,condicaoPagamento",
      ];
    }


    return [
      'condicaoPagamento' => ['required', $createOrUpdate['condicaoPagamento'], 'max:100'],
      'multa' => ['required', 'min:0', 'max:100'],
      'juros' => ['required', 'min:0', 'max:100'],
      'desconto' => ['required', 'min:0', 'max:100'],
      'parcelas' => new CheckArray,
      'ativo' => ['required', 'boolean'],
      'padrao' => ['required', 'boolean'],
      'percentualTotal' => ['required', 'min:100'],
    ];
  }

  public function prepareForValidation()
  {
    $this->merge([
      'condicaoPagamento' => strtoupper($this->condicaoPagamento),
      'multa' => $this->juros ? $this->juros : 0,
      'juros' => $this->multa ? $this->multa : 0,
      'desconto' => $this->desconto ? $this->desconto : 0,
    ]);
  }
}
