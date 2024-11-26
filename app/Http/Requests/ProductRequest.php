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
      'measure_id' => ['required', 'exists:measures,id'], // Garantir que a medida exista,
      'supplier_id' => ['required', 'exists:suppliers,id'], // Garantir que a medida exista,
      'ativo' => ['required', 'boolean'],
    ];
  }

  public function prepareForValidation()
  {
    $this->merge([
      'precoCusto' => $this->formatDecimalValue($this->precoCusto),
      'precoVenda' => $this->formatDecimalValue($this->precoVenda),
      'custoUltimaCompra' => $this->formatDecimalValue($this->custoUltimaCompra),
      'custoUltimaVenda' => $this->formatDecimalValue($this->custoUltimaVenda),
      'nome' => strtoupper($this->nome),
    ]);
  }

  protected function formatDecimalValue($value)
  {
    if (is_null($value)) {
      return null;
    }

    // Remove todos os caracteres exceto números, ponto e vírgula
    $value = preg_replace('/[^\d.,]/', '', $value);

    // Substitui vírgula por ponto
    $value = str_replace(',', '.', $value);

    // Se houver mais de um ponto, mantém apenas o último
    $value = preg_replace('/\.(?=.*\.)/', '', $value);

    return $value ? (float) $value : null;
  }
}
