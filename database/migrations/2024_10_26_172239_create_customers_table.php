<?php

use App\Models\City;
use App\Models\PaymentTerm;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('customers', function (Blueprint $table) {
      $table->id();
      $table->timestamps();

      // Campos correspondentes à model de Supplier
      $table->char('tipoPessoa', 1); // Tipo de pessoa
      $table->string('clienteRazaoSocial'); // Razão social
      $table->string('cpfCnpj');
      $table->string('rgIe')->nullable();
      $table->string('endereco'); // Endereço
      $table->string('bairro'); // Bairro
      $table->string('numero'); // Número do endereço
      $table->string('cep'); // CEP
      $table->string('apelidoNomeFantasia')->nullable(); // Nome fantasia
      $table->string('complemento')->nullable(); // Complemento (opcional)
      $table->string('sexo')->nullable(); // Sexo (opcional)
      $table->string('email')->nullable(); // Email (opcional)
      $table->string('usuario')->nullable(); // Usuário (opcional)
      $table->string('telefone')->nullable(); // Telefone (opcional)
      $table->string('celular'); // Celular (opcional)
      $table->string('nomeContato')->nullable(); // Nome do contato (opcional)
      $table->date('dataNasc')->nullable(); // Data de nascimento (opcional)
      $table->boolean('ativo')->default(true); // Ativo (padrão é true)

      // Chaves estrangeiras
      $table->foreignIdFor(City::class, 'city_id')->constrained()->onDelete('restrict');
      $table->foreignIdFor(PaymentTerm::class, 'payment_term_id')->constrained()->onDelete('restrict');
    });
  }

  public function down()
  {
    Schema::dropIfExists('customer');
  }
};
