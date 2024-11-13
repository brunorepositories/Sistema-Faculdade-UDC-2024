<?php

use App\Models\City;
use App\Models\PaymentTerm;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('suppliers', function (Blueprint $table) {
      $table->id();
      $table->timestamps();

      $table->char('tipoPessoa');
      $table->string('fornecedorRazaoSocial');
      $table->string('apelidoNomeFantasia')->nullable();
      $table->string('endereco');
      $table->string('bairro');
      $table->string('numero');
      $table->string('cep');
      $table->string('complemento')->nullable(); // Adicionando nullable se for opcional
      $table->string('sexo')->nullable();
      $table->string('email')->nullable();
      $table->string('usuario')->nullable();
      $table->string('telefone')->nullable();
      $table->string('celular')->nullable();
      $table->string('nomeContato')->nullable();
      $table->date('dataNasc')->nullable(); // data em C# é DateTime em Laravel
      $table->string('cpf')->nullable();
      $table->string('cnpj')->nullable();
      $table->string('ie')->nullable();
      $table->string('rg')->nullable();
      $table->boolean('ativo')->default(true); // Default como ativo

      // Se você tiver chaves estrangeiras, você pode adicionar:
      $table->foreignIdFor(City::class, 'city_id')->constrained()->onDelete('restrict');
      $table->foreignIdFor(PaymentTerm::class, 'payment_term_id')->constrained()->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('suppliers');
  }
};
