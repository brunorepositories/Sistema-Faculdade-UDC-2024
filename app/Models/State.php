<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  use HasFactory;

  protected $fillable = [
    'nome',
    'uf',
  ];

  public function countries()
  {
    return $this->belongsTo(Country::class);
  }

  public function cities()
  {
    return $this->hasMany(City::class, 'city_id');
  }
}