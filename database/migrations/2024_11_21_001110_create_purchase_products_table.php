<?php

use App\Models\Product;
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
    Schema::create('purchase_products', function (Blueprint $table) {
      $table->id();  // Cria uma chave primária auto-incremental
      // Define os campos que compõem a chave primária composta
      $table->integer('numeroNota');
      $table->integer('modelo');
      $table->integer('serie');
      $table->foreignIdFor(Supplier::class, 'supplier_id')->constrained()->onDelete('restrict');
      $table->foreignIdFor(Product::class, 'product_id')->constrained()->onDelete('restrict');

      // Define os outros campos
      $table->decimal('precoProduto', 10, 2);
      $table->integer('qtdProduto');
      $table->decimal('descontoProduto', 10, 2)->nullable();
      $table->decimal('custoMedio', 10, 2);
      $table->decimal('custoUltCompra', 10, 2);
      $table->decimal('rateio', 10, 2)->nullable();

      // Definir a chave primária composta
      $table->primary(['numeroNota', 'modelo', 'serie', 'supplier_id', 'product_id']);

      // Adiciona timestamps (created_at e updated_at)
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('purchase_products');
  }
};
