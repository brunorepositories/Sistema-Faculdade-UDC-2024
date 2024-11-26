<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountPayableRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'numeroNota' => ['required', 'integer'],
      'modelo' => ['required', 'integer'],
      'serie' => ['required', 'integer'],
      'supplier_id' => ['required', 'exists:suppliers,id'],
      'parcela' => ['required', 'integer'],
      'dataVencimento' => ['required', 'date'],
      'dataPagamento' => ['nullable', 'date'],
      'dataCancelamento' => ['nullable', 'date'],
      'valorParcela' => ['required', 'numeric', 'min:0'],
      'valorPago' => ['nullable', 'numeric', 'min:0'],
      'juros' => ['nullable', 'numeric', 'min:0'],
      'multa' => ['nullable', 'numeric', 'min:0'],
      'desconto' => ['nullable', 'numeric', 'min:0'],
      'payment_form_id' => ['required', 'exists:payment_forms,id'],
      'status' => ['required', 'string', 'in:pendente,pago,cancelado'], // Assume valores fixos possíveis para o status
    ];
  }

  public function prepareForValidation()
  {
    $this->merge([
      'valorParcela' => $this->formatDecimalValue($this->valorParcela),
      'valorPago' => $this->formatDecimalValue($this->valorPago),
      'juros' => $this->formatDecimalValue($this->juros),
      'multa' => $this->formatDecimalValue($this->multa),
      'desconto' => $this->formatDecimalValue($this->desconto),
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
