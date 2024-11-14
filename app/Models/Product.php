<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  protected $fillable = [
    'id',
    'nome',
    'estoque',
    'precoCusto',
    'custoUltimaCompra',
    'dtUltimaCompra',
    'precoVenda',
    'precoUltimaVenda',
    'dtUltimaVenda',
    'measure_id',
    'supplier_id',
    'ativo',
  ];

  public function measure()
  {
    return $this->belongsTo(Measure::class, 'measure_id');
  }

  public function supplier()
  {
    return $this->belongsTo(Supplier::class, 'supplier_id');
  }


  // public function productsPursache()
  // {
  //   return $this->hasMany(ProductsPursache::class, 'productsPursache_id');
  // }

  // public function productsSale()
  // {
  //   return $this->hasMany(ProductsSale::class, 'productsSale_id');
  // }
}
