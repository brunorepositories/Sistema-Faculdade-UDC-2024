<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
  use HasFactory;

  protected $fillable = [
    'nome',
    'sigla',
    'ativo',
  ];

  public function products()
  {
    return $this->hasMany(Product::class, 'product_id');
  }
}
