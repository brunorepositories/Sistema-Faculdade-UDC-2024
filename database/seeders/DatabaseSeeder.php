<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
    ]);

    // Ordem das tabelas deve ser respeitada aqui
    $this->call([
      CountrySeeder::class,        // Tabela de países precisa ser populada primeiro
      StateSeeder::class,          // Estados dependem de Country
      CitySeeder::class,           // Cidades dependem de State
      PaymentFormSeeder::class,    // Formas de pagamento
      PaymentTermSeeder::class,    // Termos de pagamento, que também não têm dependências
      InstallmentSeeder::class,    // Parcelas dependem de PaymentForm e PaymentTerm
      SupplierSeeder::class,             // Fornecedores dependem de City
      CustomerSeeder::class,
      MeasureSeeder::class,        // Medidas podem ser preenchidas sem dependências
      ProductSeeder::class,        // Produtos não têm dependências de outras tabelas, mas usam Measure
      // PurchaseSeeder::class,        // Produtos não têm dependências de outras tabelas, mas usam Measure
    ]);
  }
}
