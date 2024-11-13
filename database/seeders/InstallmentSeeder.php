<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Installment;
use App\Models\PaymentForm;
use App\Models\PaymentTerm;
use Faker\Factory as Faker;

class InstallmentSeeder extends Seeder
{
  public function run()
  {
    $faker = Faker::create();
    $paymentForms = PaymentForm::all();
    $paymentTerms = PaymentTerm::all();

    foreach ($paymentForms as $paymentForm) {
      foreach ($paymentTerms as $paymentTerm) {
        foreach (range(1, 5) as $index) {
          Installment::create([
            'payment_form_id' => $paymentForm->id,
            'payment_term_id' => $paymentTerm->id,
            'parcela' => $faker->numberBetween(1, 12),
            'dias' => $faker->numberBetween(1, 30),
            'percentual' => $faker->randomFloat(2, 1, 10),
          ]);
        }
      }
    }
  }
}
