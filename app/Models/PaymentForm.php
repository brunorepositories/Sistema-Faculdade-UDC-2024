<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentForm extends Model
{
  use HasFactory;

  protected $table = 'payment_forms';

  protected $fillable = [
    'formaPagamento',
    'ativo'
  ];

  // public function toSearchableArray()
  // {
  //   return [
  //     'id' => $this->id,
  //     'formaPagamento' => $this->name,
  //   ];
  // }
}
