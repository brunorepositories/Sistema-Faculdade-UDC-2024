<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    // Verifica se estamos atualizando uma compra
    if ($this->route('purchase')) {
      $purchaseId = $this->route('purchase')->id;
      $uniqueNumeroNota = "unique:purchases,numero_nota,{$purchaseId},id,supplier_id,{$this->supplier_id}";
    } else {
      // Para criação, apenas a regra de unicidade
      $uniqueNumeroNota = "unique:purchases,numero_nota,NULL,id,supplier_id,{$this->supplier_id}";
    }

    return [
      'numeroNota' => ['required', 'max:50', $uniqueNumeroNota],
      'modelo' => ['required', 'max:10'],
      'serie' => ['required', 'max:10'],
      'supplier_id' => ['required', 'exists:suppliers,id'],
      'dataEmissao' => ['required', 'date', 'before_or_equal:now'],
      'dataChegada' => ['required', 'date', 'after_or_equal:data_emissao'],
      'tipoFrete' => ['required', 'max:1'],
      'valorFrete' => ['nullable', 'numeric', 'min:0'],
      'valorSeguro' => ['nullable', 'numeric', 'min:0'],
      'outrasDespesas' => ['nullable', 'numeric', 'min:0'],
      'totalProdutos' => ['required', 'numeric', 'min:0.01'],
      'totalPagar' => ['required', 'numeric', 'min:0.01'],
      'payment_term_id' => ['required', 'exists:payment_terms,id'],
      'observacao' => ['nullable', 'max:1000'],
      'dataCancelamento' => ['nullable', 'date', 'after_or_equal:data_emissao'],
    ];
  }

  protected function prepareForValidation()
  {
    $this->merge([
      'numeroNota' => strtoupper($this->numeroNota),
      'modelo' => strtoupper($this->modelo),
      'serie' => strtoupper($this->serie),
      'tipoFrete' => strtoupper($this->tipoFrete),
      'observacao' => $this->observacao ? strtoupper($this->observacao) : null,
      // Formatação de valores numéricos se necessário
      'valorFrete' => $this->formatDecimalValue($this->valorFrete),
      'valorSeguro' => $this->formatDecimalValue($this->valorSeguro),
      'outrasDespesas' => $this->formatDecimalValue($this->outrasDespesas),
      'totalProdutos' => $this->formatDecimalValue($this->totalProdutos),
      'totalPagar' => $this->formatDecimalValue($this->totalPagar),
    ]);
  }

  /**
   * Formata valores decimais, removendo caracteres não numéricos e convertendo vírgula para ponto
   *
   * @param mixed $value
   * @return float|null
   */
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
