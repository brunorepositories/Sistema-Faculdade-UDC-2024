<?php

use App\Models\PaymentTerm;
use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('sales', function (Blueprint $table) {
      $table->id();

      $table->integer('numeroNota');
      $table->integer('modelo');
      $table->integer('serie');

      $table->date('dataEmissao');
      $table->decimal('valorFrete', 10, 2)->nullable();
      $table->decimal('valorSeguro', 10, 2)->nullable();
      $table->decimal('outrasDespesas', 10, 2)->nullable();

      $table->decimal('desconto', 10, 2)->nullable();
      $table->decimal('totalProdutos', 15, 2);
      $table->decimal('totalPagar', 15, 2);

      $table->enum('status', ['processado', 'faturado', 'cancelado'])->default('processado');

      $table->text('observacao')->nullable();

      $table->foreignIdFor(Customer::class, 'customer_id')->constrained()->onDelete('restrict');
      $table->foreignIdFor(PaymentTerm::class, 'payment_term_id')->constrained()->onDelete('restrict');

      $table->timestamp('dataCancelamento')->nullable();
      $table->timestamps();

      // Chave composta
      $table->unique(['numeroNota', 'modelo', 'serie', 'customer_id'], 'unique_sale');
    });
  }

  public function down()
  {
    Schema::dropIfExists('sales');
  }
};
