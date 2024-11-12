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
    if ($this->route('suppliers')) {
      $supplierId = $this->route('suppliers')->id;

      $uniqueRazaoSocial = "unique:suppliers,fornecedorRazaoSocial,$supplierId";
      $uniqueCnpj = "unique:suppliers,cnpj,$supplierId";
      $uniqueCpf = "unique:suppliers,cpf,$supplierId";
    } else {
      // Para criação, apenas a regra de unicidade
      $uniqueRazaoSocial = "unique:suppliers,fornecedorRazaoSocial";
      $uniqueCnpj = "unique:suppliers,cnpj";
      $uniqueCpf = "unique:suppliers,cpf";
    }

    return [
      'tipoPessoa' => ['required'],
      'fornecedorRazaoSocial' => ['required', 'max:255', $uniqueRazaoSocial],
      'apelidoNomeFantasia' => ['required', 'max:100'],
      'endereco' => ['required', 'max:255'],
      'bairro' => ['required', 'max:100'],
      'numero' => ['required', 'max:10'],
      'cep' => ['required', 'max:10'],
      'complemento' => ['max:255'],
      'sexo' => ['max:1'],
      'email' => ['email', 'max:255'],
      'usuario' => ['max:50'],
      'telefone' => ['max:20'],
      'celular' => ['max:20'],
      'nomeContato' => ['max:100'],
      'dataNasc' => ['date'],
      'cpf' => ['max:14', $uniqueCpf], // Adicionando a regra de unicidade
      'cnpj' => ['max:18', $uniqueCnpj], // Adicionando a regra de unicidade
      'ie' => ['max:20'],
      'rg' => ['max:20'],
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
      'apelidoNomeFantasia' => strtoupper($this->apelidoNomeFantasia),
      'endereco' => strtoupper($this->endereco),
      'bairro' => strtoupper($this->bairro),
      'numero' => strtoupper($this->numero),
      'cep' => strtoupper($this->cep),
      'complemento' => $this->complemento ? strtoupper($this->complemento) : null,
      'sexo' => $this->sexo ? strtoupper($this->sexo) : null,
      'email' => $this->email ? strtoupper($this->email) : null,
      'usuario' => $this->usuario ? strtoupper($this->usuario) : null,
      'telefone' => $this->telefone ? strtoupper($this->telefone) : null,
      'celular' => $this->celular ? strtoupper($this->celular) : null,
      'nomeContato' => $this->nomeContato ? strtoupper($this->nomeContato) : null,
      'cpf' => $this->cpf ? strtoupper($this->cpf) : null,
      'cnpj' => $this->cnpj ? strtoupper($this->cnpj) : null,
      'ie' => $this->ie ? strtoupper($this->ie) : null,
      'rg' => $this->rg ? strtoupper($this->rg) : null,
    ]);
  }
}
