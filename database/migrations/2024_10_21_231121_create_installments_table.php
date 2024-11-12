<?php

use App\Models\PaymentForm;
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
    Schema::create('installments', function (Blueprint $table) {
      // Adiciona o campo id como chave primária autoincrementável
      $table->id();  // Este campo vai gerar o campo 'id' como chave primária

      // Define as chaves estrangeiras para as tabelas payment_forms e payment_terms
      $table->foreignIdFor(PaymentForm::class, 'payment_form_id')->constrained()->onDelete('restrict');
      $table->foreignIdFor(PaymentTerm::class, 'payment_term_id')->constrained()->onDelete('cascade');

      // Define a chave primária composta por payment_form_id, payment_term_id e o novo id
      $table->primary(['payment_form_id', 'payment_term_id', 'id']);

      // Campos adicionais para as parcelas
      $table->integer('parcela');
      $table->integer('dias');
      $table->float('percentual');

      // Campos de timestamp
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('installments');
  }
};
