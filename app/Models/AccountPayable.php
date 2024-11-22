<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPayable extends Model
{
  use HasFactory;
  protected $table = 'account_payables';

  protected $fillable = [
    'numeroNota',
    'modelo',
    'serie',
    'supplier_id',
    'parcela',
    'dataVencimento',
    'dataPagamento',
    'dataCancelamento',
    'valorParcela',
    'valorPago',
    'juros',
    'multa',
    'desconto',
    'payment_form_id',
    'status',
  ];

  protected $casts = [
    'dataVencimento' => 'date',
    'dataPagamento' => 'date',
    'dataCancelamento' => 'date',
    'valorParcela' => 'decimal:2',
    'valorPago' => 'decimal:2',
    'juros' => 'decimal:2',
    'multa' => 'decimal:2',
    'desconto' => 'decimal:2',
  ];

  public function supplier()
  {
    return $this->belongsTo(Supplier::class, 'supplier_id');
  }

  public function paymentForm()
  {
    return $this->belongsTo(PaymentForm::class, 'payment_form_id');
  }
}
