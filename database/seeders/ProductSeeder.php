<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Measure;
use App\Models\Supplier;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
  public function run()
  {
    $faker = Faker::create();
    $measures = Measure::all();
    $suppliers = Supplier::all();

    foreach (range(1, 20) as $index) {
      Product::create([
        'nome' => strtoupper($faker->word),
        'estoque' => $faker->numberBetween(1, 100),
        'precoVenda' => $faker->randomFloat(2, 15, 150),
        'ativo' => true,
        'measure_id' => $measures->random()->id,
        'supplier_id' => $suppliers->random()->id,
      ]);
    }
  }
}
