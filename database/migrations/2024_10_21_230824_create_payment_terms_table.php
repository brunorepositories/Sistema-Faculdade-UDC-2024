<?php

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
    Schema::create('payment_terms', function (Blueprint $table) {
      $table->id();
      $table->timestamps();

      $table->string('condicaoPagamento', 100);
      $table->double('multa', 8, 2);
      $table->double('juro', 8, 2);
      $table->double('desconto', 8, 2);
      $table->integer('qtdParcelas');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('payment_terms');
  }
};
