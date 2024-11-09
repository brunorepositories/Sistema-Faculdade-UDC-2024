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
    // 'ativo'
  ];

  // public function product()
  // {
  //   return $this->belongsTo(Product::class, 'measure_id');
  // }
}
