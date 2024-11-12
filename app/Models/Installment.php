<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
  use HasFactory;

  protected $primaryKey = ['payment_term_id', 'payment_form_id'];

  public $incrementing = false;

  protected $fillable = [
    'id',
    'payment_term_id',
    'payment_form_id',
    'parcela',
    'dias',
    'percentual',
  ];

  public function paymentForm()
  {
    return $this->belongsTo(PaymentForm::class);
  }

  public function paymentTerm()
  {
    return $this->belongsTo(PaymentTerm::class);
  }
}
