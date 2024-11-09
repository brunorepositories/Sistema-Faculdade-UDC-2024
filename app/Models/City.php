<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  use HasFactory;

  protected $fillable = [
    'nome',
    'ddd',
    'state_id',
    'ativo'
  ];

  public function state()
  {
    return $this->belongsTo(State::class);
  }

  // public function suppliers()
  // {
  //   return $this->belongsTo(Suplier::class);
  // }

  // public function customers()
  // {
  //   return $this->belongsTo(Customer::class);
  // }
}
