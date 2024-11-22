<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTerm extends Model
{
  use HasFactory;

  protected $table = 'payment_terms';

  protected $fillable = [
    'condicaoPagamento',
    'multa',
    'juros',
    'desconto',
    'qtdParcelas',
    'payment_forms_id',
    'ativo',
    'padrao',
  ];

  public function installments()
  {
    return $this->hasMany(Installment::class, 'payment_term_id');
  }
}
