<?php

namespace App\Models;

use DateTimeInterface;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  use HasFactory;

  // protected $guarded  = ['id', 'created_at', 'updated_at'];
  // protected $hidden = ['created_at', 'updated_at'];

  protected $fillable = [
    'id',
    'nome',
    'sigla',
    'ddi',
    'ativo',
  ];


  public function states()
  {
    return $this->hasMany(State::class, 'contry_id');
  }
}
