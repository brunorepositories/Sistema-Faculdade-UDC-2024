<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {

    // dd('teste');
    // Verifica se estamos atualizando um fornecedor
    if ($this->route('supplier')) {
      $supplierId = $this->route('supplier')->id;

      $uniqueRazaoSocial = "unique:suppliers,fornecedorRazaoSocial,$supplierId";
      $uniqueCpfCnpj = "unique:suppliers,cpfCnpj,$supplierId";
    } else {
      // Para criação, apenas a regra de unicidade
      $uniqueRazaoSocial = "unique:suppliers,fornecedorRazaoSocial";
      $uniqueCpfCnpj = "unique:suppliers,cpfCnpj";
    }

    if ($this->tipoPessoa === 'F') {
      $validacaoNomeContato = ['max:100'];
    } else {
      $validacaoNomeContato = ['required', 'max:100'];
    }

    return [
      'tipoPessoa' => ['required'],
      'fornecedorRazaoSocial' => ['required', 'max:255', $uniqueRazaoSocial],
      'cpfCnpj' => ['required', 'max:14', "cpf_ou_cnpj", $uniqueCpfCnpj], // Adicionando a regra de unicidade
      'apelidoNomeFantasia' => ['max:100'],
      'endereco' => ['required', 'max:255'],
      'bairro' => ['required', 'max:100'],
      'numero' => ['required', 'max:10'],
      'cep' => ['required', 'max:10'],
      'complemento' => ['max:255'],
      'sexo' => ['max:1'],
      'email' => ['email', 'max:255'],
      'usuario' => ['max:50'],
      'telefone' => ['max:20'],
      'celular' => ['required', 'max:20'],
      'nomeContato' => $validacaoNomeContato,
      'dataNasc' => ['nullable', 'date', 'before:now'],
      'rgIe' => ['max:20'],
      'ativo' => ['required', 'boolean'],
      'city_id' => ['required', 'exists:cities,id'], // Verifica se a cidade existe
      'payment_term_id' => ['required', 'exists:payment_terms,id'], // Verifica se o termo de pagamento existe
    ];
  }

  protected function prepareForValidation()
  {
    $this->merge([
      'tipoPessoa' => strtoupper($this->tipoPessoa),
      'fornecedorRazaoSocial' => strtoupper($this->fornecedorRazaoSocial),
      'cpfCnpj' => $this->cleanDocument(strtoupper($this->cpfCnpj)),
      'rgIe' => $this->rgIe ? strtoupper($this->rgIe) : null,
      'endereco' => strtoupper($this->endereco),
      'bairro' => strtoupper($this->bairro),
      'numero' => strtoupper($this->numero),
      'cep' => strtoupper($this->cep),
      'apelidoNomeFantasia' => $this->apelidoNomeFantasia ? strtoupper($this->apelidoNomeFantasia) : null,
      'complemento' => $this->complemento ? strtoupper($this->complemento) : null,
      'sexo' => $this->sexo ? strtoupper($this->sexo) : null,
      'email' => $this->email ? strtoupper($this->email) : null,
      'usuario' => $this->usuario ? strtoupper($this->usuario) : null,
      'telefone' => $this->telefone ? strtoupper($this->telefone) : null,
      'celular' => strtoupper($this->celular),
      'nomeContato' => $this->nomeContato ? strtoupper($this->nomeContato) : null,
    ]);
  }

  /**
   * Função para limpar documentos (CPF ou CNPJ), removendo caracteres não numéricos.
   *
   * @param string $document
   * @return string
   */
  protected function cleanDocument($document)
  {
    // Remove qualquer caractere que não seja número
    return preg_replace('/\D/', '', $document);
  }
}
