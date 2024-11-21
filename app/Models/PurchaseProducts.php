<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProducts extends Model
{
  use HasFactory;

  // Definindo a chave primária composta
  protected $primaryKey = ['numeroNota', 'modelo', 'serie', 'supplier_id', 'product_id'];

  public $incrementing = false;  // Para chave primária composta, não é auto-incremental

  protected $fillable = [
    'numeroNota',
    'modelo',
    'serie',
    'supplier_id',
    'product_id',
    'precoProduto',
    'qtdProduto',
    'descontoProduto',
    'custoMedio',
    'custoUltCompra',
    'rateio',
  ];

  // Relacionamento com Supplier
  public function supplier()
  {
    return $this->belongsTo(Supplier::class, 'supplier_id');
  }

  // Relacionamento com Product
  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id');
  }
}
