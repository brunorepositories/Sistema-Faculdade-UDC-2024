<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Faker\Factory as Faker;

class CountrySeeder extends Seeder
{
  public function run()
  {
    $faker = Faker::create();
    foreach (range(1, 10) as $index) {
      Country::create([
        'nome' => strtoupper($faker->country),
        'sigla' => strtoupper($faker->stateAbbr),
        'ddi' => $faker->numberBetween(1, 999),
        'ativo' => true,
      ]);
    }
  }
}
