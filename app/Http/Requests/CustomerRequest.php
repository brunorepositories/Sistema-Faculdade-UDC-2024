<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true; // Permite a autorização para todas as requisições
  }

  public function rules(): array
  {
    // Verifica se estamos atualizando um cliente
    if ($this->route('customer')) {
      $customerId = $this->route('customer')->id;

      // Regras de unicidade para a atualização
      $uniqueRazaoSocial = "unique:customers,clienteRazaoSocial,$customerId";
      $uniqueCpfCnpj = "unique:customers,cpfCnpj,$customerId";
    } else {
      // Para criação, apenas a regra de unicidade
      $uniqueRazaoSocial = "unique:customers,clienteRazaoSocial";
      $uniqueCpfCnpj = "unique:customers,cpfCnpj";
    }

    if ($this->tipoPessoa === 'F') {
      $validacaoNomeContato = ['max:100'];
    } else {
      $validacaoNomeContato = ['required', 'max:100'];
    }

    return [
      'tipoPessoa' => ['required'],
      'clienteRazaoSocial' => ['required', 'max:255', $uniqueRazaoSocial],
      'cpfCnpj' => ['required', 'max:14', "cpf_ou_cnpj", $uniqueCpfCnpj], // Adicionando a regra de unicidade
      'rgIe' => ['max:20'],
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
      'ativo' => ['required', 'boolean'],
      'city_id' => ['required', 'exists:cities,id'], // Verifica se a cidade existe
      'payment_term_id' => ['required', 'exists:payment_terms,id'], // Verifica se o termo de pagamento existe
    ];
  }

  // public function messages()
  // {

  //   return [
  //     'customer.cpfCnpj' => 'CPF ou CNPJ inválidos!'
  //   ];
  // }
  protected function prepareForValidation()
  {
    $this->merge([
      'tipoPessoa' => strtoupper($this->tipoPessoa),
      'clienteRazaoSocial' => strtoupper($this->clienteRazaoSocial),
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
      'dataNasc' => $this->dataNasc ? $this->dataNasc : null,
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
