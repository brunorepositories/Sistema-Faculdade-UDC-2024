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
    Schema::create('countries', function (Blueprint $table) {
      $table->id();
      $table->timestamps();

      $table->string('nome', 50);
      $table->char('sigla', 3);
      $table->unsignedSmallInteger('ddi');
      $table->boolean('ativo')->default(true);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('countries');
  }
};
