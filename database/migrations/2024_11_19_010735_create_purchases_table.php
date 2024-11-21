<?php

use App\Models\PaymentTerm;
use App\Models\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('purchases', function (Blueprint $table) {
      $table->id(); // ID principal (chave primária)

      $table->integer('numeroNota'); // Número da nota
      $table->integer('modelo'); // Modelo da nota
      $table->integer('serie'); // Série da nota

      $table->date('dataEmissao'); // Data de emissão
      $table->date('dataChegada'); // Data de chegada
      $table->char('tipoFrete', 3); // Tipo de frete (bool)
      $table->decimal('valorFrete', 10, 2)->nullable(); // Valor do frete (opcional)
      $table->decimal('valorSeguro', 10, 2)->nullable(); // Valor do seguro (opcional)
      $table->decimal('outrasDespesas', 10, 2)->nullable(); // Outras despesas (opcional)

      $table->decimal('totalProdutos', 15, 2); // Total dos produtos
      $table->decimal('totalPagar', 15, 2); // Total a pagar

      $table->text('observacao')->nullable(); // Observação (opcional)

      $table->foreignIdFor(Supplier::class, 'supplier_id')->constrained()->onDelete('restrict');
      $table->foreignIdFor(PaymentTerm::class, 'payment_term_id')->constrained()->onDelete('restrict');

      $table->timestamp('dataCancelamento')->nullable(); // Data de cancelamento (opcional)
      $table->timestamps(); // Data de cadastro e última alteração (created_at, updated_at)

      // Chave composta
      $table->primary(['numeroNota', 'modelo', 'serie', 'supplier_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('notas_compra');
  }
};
