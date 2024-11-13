<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\City;
use App\Models\PaymentTerm;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
  public function run()
  {
    $faker = Faker::create();

    // Pegando as cidades e os termos de pagamento existentes no banco
    $cities = City::all();
    $paymentTerms = PaymentTerm::all();

    foreach (range(1, 10) as $index) {
      Customer::create([
        'tipoPessoa' => strtoupper($faker->randomElement(['F', 'J'])),
        'clienteRazaoSocial' => strtoupper($faker->company),
        'apelidoNomeFantasia' => strtoupper($faker->companySuffix),
        'endereco' => strtoupper($faker->address),
        'bairro' => strtoupper($faker->word),
        'numero' => strtoupper($faker->buildingNumber),
        'cep' => strtoupper($faker->postcode),
        'complemento' => strtoupper($faker->optional()->word),
        'sexo' => strtoupper($faker->randomElement(['M', 'F'])),
        'email' => strtoupper($faker->email),
        'usuario' => strtoupper($faker->userName),
        'telefone' => strtoupper($faker->phoneNumber),
        'celular' => strtoupper($faker->phoneNumber),
        'nomeContato' => strtoupper($faker->name),
        'dataNasc' => $faker->date(),
        'cpf' => strtoupper($faker->buildingNumber),
        'cnpj' => strtoupper($faker->buildingNumber),
        'ie' => strtoupper($faker->word),
        'rg' => strtoupper($faker->word),
        'ativo' => true,
        'city_id' => $cities->random()->id,
        'payment_term_id' => $paymentTerms->random()->id,
      ]);
    }
  }
}
