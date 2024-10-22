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

    if ($this->route('product')) {
      $createOrUpdate = [
        'nome' => "unique:products,nome," . $this->route('product')->id,
      ];
    } else {
      $createOrUpdate = [
        'nome' => "unique:products,nome",
      ];
    }

    return [
      'nome' => ['required', $createOrUpdate['nome'], 'max:150'],
      'estoque' => ['required', 'min:0'],
      'precoCusto' => ['nullable', 'min:0'],
      'custoUltimaCompra' => ['nullable', 'min:0'],
      'dtUltimaCompra' => ['nullable', 'date'],
      'precoVenda' => ['required', 'min:0'],
      'custoUltimaVenda' => ['nullable', 'min:0'],
      'dtUltimaVenda' => ['nullable', 'date'],
      'measure_id' => ['required', 'exists:measures,id'], // Garantir que a medida exista
    ];
  }
}
