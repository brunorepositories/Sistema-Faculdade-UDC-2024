<?php

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('sale_products', function (Blueprint $table) {
      $table->id();

      // Campos da chave composta
      $table->integer('numeroNota');
      $table->integer('modelo');
      $table->integer('serie');
      $table->foreignIdFor(Customer::class, 'customer_id')->constrained()->onDelete('restrict');
      $table->foreignIdFor(Product::class, 'product_id')->constrained()->onDelete('restrict');

      // Campos de valor e quantidade
      $table->decimal('precoProduto', 10, 2);
      $table->integer('qtdProduto');
      $table->decimal('descontoProduto', 10, 2)->nullable();

      $table->timestamps();

      // Chave composta
      $table->unique(['numeroNota', 'modelo', 'serie', 'customer_id', 'product_id'], 'unique_sale_product');
    });
  }

  public function down()
  {
    Schema::dropIfExists('sale_products');
  }
};
