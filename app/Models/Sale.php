<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
  protected $fillable = [
    'numeroNota',
    'modelo',
    'serie',
    'customer_id',
    'dataEmissao',
    'valorFrete',
    'valorSeguro',
    'outrasDespesas',
    'subTotal',
    'desconto',
    'totalProdutos',
    'totalPagar',
    'payment_term_id',
    'observacao',
    'dataCancelamento'
  ];

  protected $casts = [
    'dataEmissao' => 'date',
    'valorFrete' => 'decimal:2',
    'valorSeguro' => 'decimal:2',
    'outrasDespesas' => 'decimal:2',
    'subTotal' => 'decimal:2',
    'desconto' => 'decimal:2',
    'totalProdutos' => 'decimal:2',
    'totalPagar' => 'decimal:2',
    'dataCancelamento' => 'datetime'
  ];

  public function customer(): BelongsTo
  {
    return $this->belongsTo(Customer::class);
  }

  public function products()
  {
    return $this->belongsToMany(Product::class, 'sale_products')
      ->withPivot([
        'precoProduto',
        'qtdProduto',
        'descontoProduto',
        'custoMedio',
      ])
      ->withTimestamps();
  }

  public function accountReceivable()
  {
    return $this->hasMany(AccountReceivable::class, ['numeroNota', 'modelo', 'serie', 'customer_id']);
  }

  public function paymentTerm(): BelongsTo
  {
    return $this->belongsTo(PaymentTerm::class);
  }

  public function estaCancelada(): bool
  {
    return !is_null($this->dataCancelamento);
  }

  public function getTotalDespesasAdicionais(): float
  {
    return (float) ($this->valorFrete ?? 0) +
      (float) ($this->valorSeguro ?? 0) +
      (float) ($this->outrasDespesas ?? 0);
  }

  public function getTotalComDesconto(): float
  {
    return $this->totalProdutos - ($this->desconto ?? 0) + ($this->acrescimo ?? 0);
  }
}
