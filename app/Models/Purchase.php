<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
  /**
   * A tabela associada ao modelo.
   *
   * @var string
   */
  protected $table = 'purchases';

  /**
   * Os atributos que são atribuíveis em massa.
   *
   * @var array
   */
  protected $fillable = [
    'numeroNota',
    'modelo',
    'serie',
    'supplier_id',
    'dataEmissao',
    'dataChegada',
    'tipoFrete',
    'valorFrete',
    'valorSeguro',
    'outrasDespesas',
    'totalProdutos',
    'totalPagar',
    'payment_term_id',
    'observacao',
    'dataCancelamento'
  ];

  /**
   * Os atributos que devem ser convertidos para tipos nativos.
   *
   * @var array
   */
  protected $casts = [
    'dataEmissao' => 'date',
    'dataChegada' => 'date',
    'tipoFrete' => 'char',
    'valorFrete' => 'decimal:2',
    'valorSeguro' => 'decimal:2',
    'outrasDespesas' => 'decimal:2',
    'totalProdutos' => 'decimal:2',
    'totalPagar' => 'decimal:2',
    'dataCancelamento' => 'datetime'
  ];

  /**
   * Obtém o fornecedor associado à nota de compra.
   */
  public function supplier(): BelongsTo
  {
    return $this->belongsTo(Supplier::class, 'supplier_id');
  }

  /**
   * Obtém a condição de pagamento associada à nota de compra.
   */
  public function paymentTerm(): BelongsTo
  {
    return $this->belongsTo(PaymentTerm::class, 'paymentTerm_id');
  }

  /**
   * Verifica se a nota está cancelada.
   *
   * @return bool
   */
  public function estaCancelada(): bool
  {
    return !is_null($this->data_cancelamento);
  }

  /**
   * Calcula o valor total de despesas adicionais.
   *
   * @return float
   */
  public function getTotalDespesasAdicionais(): float
  {
    return (float) ($this->valorFrete ?? 0) +
      (float) ($this->valorSeguro ?? 0) +
      (float) ($this->outrasDespesas ?? 0);
  }
}
