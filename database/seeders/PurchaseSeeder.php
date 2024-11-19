<?php

namespace Database\Seeders;

use App\Models\PaymentTerm;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PurchaseSeeder extends Seeder
{
  public function run()
  {
    $faker = Faker::create();
    $suppliers = Supplier::all();
    $paymentTerms = PaymentTerm::all();

    // Geração de 10 registros de notas de compra
    foreach (range(1, 10) as $index) {
      Purchase::create([
        'numeroNota' => $faker->numberBetween(1000, 9999),
        'modelo' => $faker->numberBetween(1, 3), // Modelo fictício
        'serie' => $faker->numberBetween(1, 5), // Série fictícia
        'supplier_id' => $suppliers->random()->id, // ID de fornecedor fictício
        'dataEmissao' => $faker->date(),
        'dataChegada' => $faker->date(),
        'tipoFrete' => $faker->boolean(),
        'valorFrete' => $faker->randomFloat(2, 0, 1000),
        'valorSeguro' => $faker->randomFloat(2, 0, 500),
        'outrasDespesas' => $faker->randomFloat(2, 0, 500),
        'totalProdutos' => $faker->randomFloat(2, 100, 5000),
        'totalPagar' => $faker->randomFloat(2, 100, 6000),
        'payment_term_id' => $paymentTerms->random()->id, // ID de condição de pagamento fictício
        'observacao' => $faker->sentence(),
        'dataCancelamento' => $faker->optional()->date(),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
