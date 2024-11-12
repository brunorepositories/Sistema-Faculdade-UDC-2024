<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  use HasFactory;

  // Nome da tabela associada ao modelo
  protected $table = 'suppliers';

  // Atributos que podem ser preenchidos em massa
  protected $fillable = [
    'id',
    'tipoPessoa',
    'fornecedorRazaoSocial',
    'apelidoNomeFantasia',
    'endereco',
    'bairro',
    'numero',
    'cep',
    'complemento',
    'sexo',
    'email',
    'usuario',
    'telefone',
    'celular',
    'nomeContato',
    'dataNasc',
    'cpf',
    'cnpj',
    'ie',
    'rg',
    'ativo',
    'city_id',
    'payment_term_id',
  ];

  // Relacionamento com a tabela City
  public function city()
  {
    return $this->belongsTo(City::class, 'city_id');
  }

  // Relacionamento com a tabela PaymentTerm
  public function paymentTerm()
  {
    return $this->belongsTo(PaymentTerm::class, 'payment_term_id');
  }
}
