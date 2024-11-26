<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountReceivable extends Model
{
  use HasFactory;

  protected $fillable = [
    'numeroNota',
    'modelo',
    'serie',
    'customer_id',
    'parcela',
    'valorParcela',
    'valorPago',
    'juros',
    'multa',
    'desconto',
    'dataVencimento',
    'dataPagamento',
    'dataCancelamento',
    'payment_form_id',
    'status',
    'observacao'
  ];

  protected $casts = [
    'valorParcela' => 'decimal:2',
    'valorPago' => 'decimal:2',
    'juros' => 'decimal:2',
    'multa' => 'decimal:2',
    'desconto' => 'decimal:2',
    'dataVencimento' => 'date',
    'dataPagamento' => 'date',
    'dataCancelamento' => 'datetime'
  ];

  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }

  public function sale()
  {
    return $this->belongsTo(Sale::class, ['numeroNota', 'modelo', 'serie', 'customer_id']);
  }

  public function paymentForm()
  {
    return $this->belongsTo(PaymentForm::class);
  }

  public function getValorAtualizado()
  {
    $valor = $this->valorParcela;
    $valor += ($this->juros ?? 0);
    $valor += ($this->multa ?? 0);
    $valor -= ($this->desconto ?? 0);
    return $valor;
  }

  public function estaPago(): bool
  {
    return $this->status === 'pago';
  }

  public function estaVencido(): bool
  {
    return !$this->estaPago() &&
      !$this->estaCancelado() &&
      $this->dataVencimento < now()->startOfDay();
  }

  public function estaCancelado(): bool
  {
    return $this->status === 'cancelado';
  }
}
