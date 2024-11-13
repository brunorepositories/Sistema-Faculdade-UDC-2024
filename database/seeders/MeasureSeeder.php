<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Measure;
use Faker\Factory as Faker;

class MeasureSeeder extends Seeder
{
  public function run()
  {
    $faker = Faker::create();
    foreach (range(1, 5) as $index) {
      Measure::create([
        'nome' => strtoupper($faker->word),
        'sigla' => strtoupper($faker->lexify('???')),
        'ativo' => true,
      ]);
    }
  }
}
