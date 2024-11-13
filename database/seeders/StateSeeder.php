<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\Country;
use Faker\Factory as Faker;

class StateSeeder extends Seeder
{
  public function run()
  {
    $faker = Faker::create();
    $countries = Country::all();

    foreach ($countries as $country) {
      foreach (range(1, 5) as $index) {
        State::create([
          'nome' => strtoupper($faker->state),
          'uf' => strtoupper($faker->stateAbbr),
          'ativo' => true,
          'country_id' => $country->id,
        ]);
      }
    }
  }
}
