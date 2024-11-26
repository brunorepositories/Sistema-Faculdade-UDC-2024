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
      // Campos principais da venda
      'numeroNota' => ['required', 'integer'],
      'modelo' => ['required', 'integer'],
      'serie' => ['required', 'integer'],
      'customer_id' => ['required', 'exists:customers,id'],
      'payment_term_id' => ['required', 'exists:payment_terms,id'],

      // Datas
      'dataEmissao' => ['required', 'date'],
      'dataSaida' => ['required', 'date', 'after_or_equal:dataEmissao'],

      // Valores gerais
      'valorFrete' => ['nullable', 'numeric', 'min:0'],
      'valorSeguro' => ['nullable', 'numeric', 'min:0'],
      'outrasDespesas' => ['nullable', 'numeric', 'min:0'],
      'subTotal' => ['required', 'numeric', 'min:0'],
      'desconto' => ['nullable', 'numeric', 'min:0'],
      'acrescimo' => ['nullable', 'numeric', 'min:0'],
      'totalProdutos' => ['required', 'numeric', 'min:0'],
      'totalPagar' => ['required', 'numeric', 'min:0'],

      // Validação da lista de produtos
      'produtos' => ['required', 'array', 'min:1'],
      'produtos.*.product_id' => ['required', 'exists:products,id'],
      'produtos.*.precoVenda' => ['required', 'numeric', 'min:0'],
      'produtos.*.qtdProduto' => ['required', 'integer', 'min:1'],
      'produtos.*.descontoProduto' => ['nullable', 'numeric', 'min:0', 'max:100'],
      'produtos.*.acrescimoProduto' => ['nullable', 'numeric', 'min:0', 'max:100'],
      'produtos.*.percentualComissao' => ['nullable', 'numeric', 'min:0', 'max:100'],

      // Validação das parcelas
      'parcelas' => ['required_if:payment_term_id,exists', 'array'],
      'parcelas.*.payment_form_id' => ['required', 'exists:payment_forms,id'],
      'parcelas.*.parcela' => ['required', 'integer', 'min:1'],
      'parcelas.*.valor' => ['required', 'numeric', 'min:0'],
      'parcelas.*.dataVencimento' => ['required', 'date', 'after_or_equal:dataSaida'],

      // Campo opcional
      'observacao' => ['nullable', 'string', 'max:1000'],
    ];
  }

  public function messages(): array
  {
    return [
      'numeroNota.required' => 'O número da nota é obrigatório',
      'modelo.required' => 'O modelo da nota é obrigatório',
      'serie.required' => 'A série da nota é obrigatória',
      'customer_id.required' => 'O cliente é obrigatório',
      'customer_id.exists' => 'Cliente não encontrado',
      'payment_term_id.required' => 'A condição de pagamento é obrigatória',
      'payment_term_id.exists' => 'Condição de pagamento não encontrada',

      'dataEmissao.required' => 'A data de emissão é obrigatória',
      'dataEmissao.date' => 'Data de emissão inválida',
      'dataSaida.required' => 'A data de saída é obrigatória',
      'dataSaida.date' => 'Data de saída inválida',
      'dataSaida.after_or_equal' => 'A data de saída deve ser igual ou posterior à data de emissão',

      'valorFrete.numeric' => 'O valor do frete deve ser um número',
      'valorFrete.min' => 'O valor do frete não pode ser negativo',
      'valorSeguro.numeric' => 'O valor do seguro deve ser um número',
      'valorSeguro.min' => 'O valor do seguro não pode ser negativo',
      'outrasDespesas.numeric' => 'O valor de outras despesas deve ser um número',
      'outrasDespesas.min' => 'O valor de outras despesas não pode ser negativo',

      'subTotal.required' => 'O subtotal é obrigatório',
      'subTotal.numeric' => 'O subtotal deve ser um número',
      'subTotal.min' => 'O subtotal não pode ser negativo',

      'desconto.numeric' => 'O desconto deve ser um número',
      'desconto.min' => 'O desconto não pode ser negativo',
      'acrescimo.numeric' => 'O acréscimo deve ser um número',
      'acrescimo.min' => 'O acréscimo não pode ser negativo',

      'totalProdutos.required' => 'O total dos produtos é obrigatório',
      'totalProdutos.numeric' => 'O total dos produtos deve ser um número',
      'totalProdutos.min' => 'O total dos produtos não pode ser negativo',

      'totalPagar.required' => 'O total a pagar é obrigatório',
      'totalPagar.numeric' => 'O total a pagar deve ser um número',
      'totalPagar.min' => 'O total a pagar não pode ser negativo',

      'produtos.required' => 'Adicione pelo menos um produto',
      'produtos.array' => 'Lista de produtos inválida',
      'produtos.min' => 'Adicione pelo menos um produto',
      'produtos.*.product_id.required' => 'O produto é obrigatório',
      'produtos.*.product_id.exists' => 'Produto não encontrado',
      'produtos.*.precoVenda.required' => 'O preço de venda é obrigatório',
      'produtos.*.precoVenda.numeric' => 'O preço de venda deve ser um número',
      'produtos.*.precoVenda.min' => 'O preço de venda não pode ser negativo',
      'produtos.*.qtdProduto.required' => 'A quantidade é obrigatória',
      'produtos.*.qtdProduto.integer' => 'A quantidade deve ser um número inteiro',
      'produtos.*.qtdProduto.min' => 'A quantidade deve ser maior que zero',
      'produtos.*.descontoProduto.numeric' => 'O desconto deve ser um número',
      'produtos.*.descontoProduto.min' => 'O desconto não pode ser negativo',
      'produtos.*.descontoProduto.max' => 'O desconto não pode ser maior que 100%',
      'produtos.*.acrescimoProduto.numeric' => 'O acréscimo deve ser um número',
      'produtos.*.acrescimoProduto.min' => 'O acréscimo não pode ser negativo',
      'produtos.*.acrescimoProduto.max' => 'O acréscimo não pode ser maior que 100%',
      'produtos.*.percentualComissao.numeric' => 'O percentual de comissão deve ser um número',
      'produtos.*.percentualComissao.min' => 'O percentual de comissão não pode ser negativo',
      'produtos.*.percentualComissao.max' => 'O percentual de comissão não pode ser maior que 100%',

      'parcelas.required_if' => 'As parcelas são obrigatórias para a condição de pagamento selecionada',
      'parcelas.array' => 'Lista de parcelas inválida',
      'parcelas.*.payment_form_id.required' => 'A forma de pagamento é obrigatória',
      'parcelas.*.payment_form_id.exists' => 'Forma de pagamento não encontrada',
      'parcelas.*.parcela.required' => 'O número da parcela é obrigatório',
      'parcelas.*.parcela.integer' => 'O número da parcela deve ser um número inteiro',
      'parcelas.*.parcela.min' => 'O número da parcela deve ser maior que zero',
      'parcelas.*.valor.required' => 'O valor da parcela é obrigatório',
      'parcelas.*.valor.numeric' => 'O valor da parcela deve ser um número',
      'parcelas.*.valor.min' => 'O valor da parcela não pode ser negativo',
      'parcelas.*.dataVencimento.required' => 'A data de vencimento é obrigatória',
      'parcelas.*.dataVencimento.date' => 'Data de vencimento inválida',
      'parcelas.*.dataVencimento.after_or_equal' => 'A data de vencimento deve ser igual ou posterior à data de saída',

      'observacao.max' => 'A observação não pode ter mais que 1000 caracteres',
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
      'subTotal' => $this->formatDecimalValue($this->subTotal),
      'desconto' => $this->formatDecimalValue($this->desconto),
      'acrescimo' => $this->formatDecimalValue($this->acrescimo),
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
