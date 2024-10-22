<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTerm extends Model
{
  use HasFactory;

  protected $fillable = [
    'condicaoPagamento',
    'multa',
    'juro',
    'desconto',
    'qtdParcelas',
  ];

  public function installments()
  {
    return $this->hasMany(Installment::class);
  }
}
