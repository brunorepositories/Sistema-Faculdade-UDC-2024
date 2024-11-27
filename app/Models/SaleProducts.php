<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProducts extends Model
{
  use HasFactory;

  protected $fillable = [
    'numeroNota',
    'modelo',
    'serie',
    'customer_id',
    'product_id',
    'precoProduto',
    'qtdProduto',
    'descontoProduto',
  ];

  protected $casts = [
    'precoProduto' => 'decimal:2',
    'descontoProduto' => 'decimal:2'
  ];

  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }

  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  public function getValorTotal()
  {
    $valorBase = $this->precoProduto * $this->qtdProduto;
    $desconto = ($valorBase * ($this->descontoProduto ?? 0)) / 100;

    return $valorBase - $desconto;
  }
}
