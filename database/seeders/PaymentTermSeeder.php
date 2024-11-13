<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentTerm;
use Faker\Factory as Faker;

class PaymentTermSeeder extends Seeder
{
  public function run()
  {
    $faker = Faker::create();
    foreach (range(1, 5) as $index) {
      PaymentTerm::create([
        'condicaoPagamento' => strtoupper($faker->word),
        'multa' => $faker->randomFloat(2, 0, 5),
        'juros' => $faker->randomFloat(2, 0, 5),
        'desconto' => $faker->randomFloat(2, 0, 5),
        'qtdParcelas' => $faker->numberBetween(1, 12),
        'ativo' => true,
      ]);
    }
  }
}
