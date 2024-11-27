<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      // Campos principais da Produto
      'numeroNota' => ['required', 'integer'],
      'modelo' => ['required', 'integer'],
      'serie' => ['required', 'integer'],
      'customer_id' => ['required', 'exists:customers,id'],
      'payment_term_id' => ['required', 'exists:payment_terms,id'],

      // Datas
      'dataEmissao' => ['required', 'date'],

      // Valores gerais
      'valorFrete' => ['nullable', 'numeric', 'min:0'],
      'valorSeguro' => ['nullable', 'numeric', 'min:0'],
      'outrasDespesas' => ['nullable', 'numeric', 'min:0'],
      'desconto' => ['nullable', 'numeric', 'min:0'],
      'totalProdutos' => ['required', 'numeric', 'min:0'],
      'totalPagar' => ['required', 'numeric', 'min:0'],

      // Validação da lista de produtos
      'produtos' => ['required', 'array', 'min:1'],
      'produtos.*.product_id' => ['required', 'exists:products,id'],
      'produtos.*.precoProduto' => ['required', 'numeric', 'min:0'],
      'produtos.*.qtdProduto' => ['required', 'integer', 'min:1'],

      // Validação das parcelas
      'parcelas' => ['required_if:payment_term_id,exists', 'array'],
      'parcelas.*.payment_form_id' => ['required', 'exists:payment_forms,id'],
      'parcelas.*.parcela' => ['required', 'integer', 'min:1'],
      'parcelas.*.valor' => ['required', 'numeric', 'min:0'],
      'parcelas.*.dataVencimento' => ['required', 'date', 'after_or_equal:dataSaida'],

    ];
  }

  protected function prepareForValidation()
  {
    $this->merge([
      'numeroNota' => strtoupper($this->numeroNota),
      'modelo' => strtoupper($this->modelo),
      'serie' => strtoupper($this->serie),
      // Formatação de valores numéricos
      'valorFrete' => $this->formatDecimalValue($this->valorFrete),
      'valorSeguro' => $this->formatDecimalValue($this->valorSeguro),
      'outrasDespesas' => $this->formatDecimalValue($this->outrasDespesas),
      'desconto' => $this->formatDecimalValue($this->desconto),
      'totalProdutos' => $this->formatDecimalValue($this->totalProdutos),
      'totalPagar' => $this->formatDecimalValue($this->totalPagar),
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
