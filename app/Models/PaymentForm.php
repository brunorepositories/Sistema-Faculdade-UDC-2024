<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentForm extends Model
{
  use HasFactory;

  protected $table = 'payment_forms';

  protected $fillable = [
    'id',
    'formaPagamento',
    'ativo',
  ];

  public function installments()
  {
    return $this->hasMany(Installment::class);
  }
}
