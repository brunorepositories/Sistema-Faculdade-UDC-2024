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
    'cpfCnpj',
    'rgIe',
    'ativo',
    'city_id',
    'payment_term_id',
  ];

  public function products()
  {
    return $this->hasMany(Product::class);
  }

  public function purchases()
  {
    return $this->hasMany(Purchase::class);
  }

  public function city()
  {
    return $this->belongsTo(City::class);
  }

  public function paymentTerm()
  {
    return $this->belongsTo(PaymentTerm::class);
  }
}
