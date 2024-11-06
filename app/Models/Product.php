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
    'custoUltimaVenda',
    'dtUltimaVenda',
    'measure_id'
  ];

  public function measure()
    {
        return $this->belongsTo(Measure::class, 'measure_id');  // Alterado para belongsTo
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
