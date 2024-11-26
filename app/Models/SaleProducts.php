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
    'precoVenda',
    'qtdProduto',
    'descontoProduto',
    'acrescimoProduto',
    'custoMedio',
    'custoUltVenda',
    'valorComissao',
    'percentualComissao'
  ];

  protected $casts = [
    'precoVenda' => 'decimal:2',
    'descontoProduto' => 'decimal:2',
    'acrescimoProduto' => 'decimal:2',
    'custoMedio' => 'decimal:2',
    'custoUltVenda' => 'decimal:2',
    'valorComissao' => 'decimal:2',
    'percentualComissao' => 'decimal:2'
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
    $valorBase = $this->precoVenda * $this->qtdProduto;
    $desconto = ($valorBase * ($this->descontoProduto ?? 0)) / 100;
    $acrescimo = ($valorBase * ($this->acrescimoProduto ?? 0)) / 100;

    return $valorBase - $desconto + $acrescimo;
  }
}
