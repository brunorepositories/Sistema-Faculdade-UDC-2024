<?php

use App\Models\PaymentForm;
use App\Models\Purchase;
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
    Schema::create('accounts_receivable', function (Blueprint $table) {
      $table->id(); // Adiciona um ID auto-incremento como chave primária única

      // Campos para referência à purchase (chave composta)
      $table->integer('numeroNota');
      $table->integer('modelo');
      $table->integer('serie');
      $table->foreignIdFor(Supplier::class, 'supplier_id')->constrained()->onDelete('restrict');
      $table->integer('parcela');

      // Datas importantes
      $table->date('dataVencimento');
      $table->date('dataPagamento')->nullable();
      $table->date('dataCancelamento')->nullable();

      // Valores
      $table->decimal('valorParcela', 10, 2);
      $table->decimal('valorPago', 10, 2)->nullable();
      $table->decimal('juros', 10, 2)->nullable();
      $table->decimal('multa', 10, 2)->nullable();
      $table->decimal('desconto', 10, 2)->nullable();

      // Relacionamentos e status
      $table->foreignIdFor(PaymentForm::class, 'payment_form_id')->constrained()->onDelete('restrict');
      $table->string('status', 20)->default('pendente');

      // Timestamps padrão do Laravel
      $table->timestamps();

      // Cria um índice único para garantir que não haja duplicidade de parcelas
      $table->unique(['numeroNota', 'modelo', 'serie', 'supplier_id', 'parcela']);

      // Adiciona a foreign key composta referenciando purchases
      $table->foreign(['numeroNota', 'modelo', 'serie', 'supplier_id'])
        ->references(['numeroNota', 'modelo', 'serie', 'supplier_id'])
        ->on('purchases')
        ->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('accounts_receivable');
  }
};
