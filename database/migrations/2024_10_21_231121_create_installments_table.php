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
      $table->primary(['payment_form_id', 'payment_term_id']);

      // Definir a chave estrangeira para a tabela payment_forms
      $table->foreignIdFor(PaymentForm::class, 'payment_form_id')->constrained()->onDelete('restrict');

      // Definir a chave estrangeira para a tabela payment_terms
      $table->foreignIdFor(PaymentTerm::class, 'payment_term_id')->constrained()->onDelete('cascade');

      $table->integer('parcela');
      $table->integer('dias');
      $table->float('percentual');

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
