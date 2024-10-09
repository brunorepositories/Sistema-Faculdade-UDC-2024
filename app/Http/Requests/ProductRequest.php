<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'nome' => ['required',  'max:50'],
      'estoque' => ['required', 'min:0'],
      'precoCusto' => ['required', 'min:0'],
      'custoUltimaCompra' => ['nullable', 'min:0'],
      'dtUltimaCompra' => ['nullable', 'date'],
      'precoVenda' => ['required', 'min:0'],
      'custoUltimaVenda' => ['nullable', 'min:0'],
      'dtUltimaVenda' => ['nullable', 'date'],
      'measure_id' => ['required', 'exists:measures,id'], // Garantir que a medida exista
    ];
  }
}
