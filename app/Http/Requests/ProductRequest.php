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
      'ativo' => ['required', 'boolean'],
    ];
  }

  public function prepareForValidation()
  {
    $this->merge([
      'precoCusto' => $this->convertCurrencyToFloat($this->precoCusto),
      'precoVenda' => $this->convertCurrencyToFloat($this->precoVenda),
      'custoUltimaCompra' => $this->convertCurrencyToFloat($this->custoUltimaCompra),
      'custoUltimaVenda' => $this->convertCurrencyToFloat($this->custoUltimaVenda),
      'nome' => strtoupper($this->nome),
    ]);
  }

  private function convertCurrencyToFloat(?string $value): ?float
  {
    if ($value) {
      // Remove "R$", substitui vírgula por ponto e remove caracteres não numéricos
      $value = preg_replace('/[^0-9,]/', '', $value);
      // Substitui a vírgula por ponto para que o valor seja aceito como decimal
      $value = str_replace(',', '.', $value);

      // Converte para float
      return (float) $value;
    }

    return null; // Se o valor for nulo, retorna nulo
  }
}
