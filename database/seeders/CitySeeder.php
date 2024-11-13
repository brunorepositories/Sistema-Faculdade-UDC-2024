<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\State;
use Faker\Factory as Faker;

class CitySeeder extends Seeder
{
  public function run()
  {
    $faker = Faker::create();
    $states = State::all();

    foreach ($states as $state) {
      foreach (range(1, 5) as $index) {
        City::create([
          'nome' => strtoupper($faker->city),
          'ddd' => $faker->numberBetween(10, 99),
          'ativo' => true,
          'state_id' => $state->id,
        ]);
      }
    }
  }
}
