<?php

use App\Models\Measure;
use App\Models\Supplier;
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
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->timestamps();

      $table->string('nome', 150);
      $table->integer('estoque');
      $table->decimal('precoCusto', 10, 2)->nullable();
      $table->decimal('custoUltimaCompra', 10, 2)->nullable();
      $table->dateTime('dtUltimaCompra')->nullable();
      $table->decimal('precoVenda', 10, 2);
      $table->decimal('precoUltimaVenda', 10, 2)->nullable();
      $table->dateTime('dtUltimaVenda')->nullable();
      $table->boolean('ativo')->default(true);

      $table->foreignIdFor(Measure::class, 'measure_id')
        ->constrained() // Cria a chave estrangeira para a tabela 'measures'
        ->onDelete('restrict'); // Impede a exclusão de Measure se houver produtos vinculados

      $table->foreignIdFor(Supplier::class, 'supplier_id')
        ->constrained() // Cria a chave estrangeira para a tabela 'measures'
        ->onDelete('restrict'); // Impede a exclusão de Measure se houver produtos vinculados
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('products');
  }
};
