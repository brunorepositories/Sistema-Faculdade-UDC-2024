<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentForm;
use Faker\Factory as Faker;

class PaymentFormSeeder extends Seeder
{
  public function run()
  {
    $faker = Faker::create();
    foreach (range(1, 5) as $index) {
      PaymentForm::create([
        'formaPagamento' => strtoupper($faker->word),
        'ativo' => true,
      ]);
    }
  }
}
