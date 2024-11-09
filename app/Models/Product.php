<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  protected $fillable = [
    'nome',
    'estoque',
    'precoCusto',
    'custoUltimaCompra',
    'dtUltimaCompra',
    'precoVenda',
    'precoUltimaVenda',
    'dtUltimaVenda',
    'measure_id',
    'ativo'
  ];

  public function measure()
  {
    return $this->hasOne(Measure::class, 'id');
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
