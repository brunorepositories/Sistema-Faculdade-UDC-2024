<?php

use App\Models\Customer;
use App\Models\PaymentForm;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('account_receivables', function (Blueprint $table) {
      $table->id();

      // Campos de identificação da venda
      $table->integer('numeroNota');
      $table->integer('modelo');
      $table->integer('serie');
      $table->foreignIdFor(Customer::class, 'customer_id')->constrained()->onDelete('restrict');
      $table->integer('parcela');

      // Campos de valor
      $table->decimal('valorParcela', 10, 2);
      $table->decimal('valorPago', 10, 2)->nullable();
      $table->decimal('juros', 10, 2)->nullable();
      $table->decimal('multa', 10, 2)->nullable();
      $table->decimal('desconto', 10, 2)->nullable();

      // Datas
      $table->date('dataVencimento');
      $table->date('dataPagamento')->nullable();
      $table->timestamp('dataCancelamento')->nullable();

      // Relacionamentos
      $table->foreignIdFor(PaymentForm::class, 'payment_form_id')->constrained()->onDelete('restrict');

      // Status
      $table->enum('status', ['pendente', 'pago', 'cancelado'])->default('pendente');

      $table->text('observacao')->nullable();
      $table->timestamps();

      // Chave composta
      $table->unique(['numeroNota', 'modelo', 'serie', 'customer_id', 'parcela'], 'unique_receivable');
    });
  }

  public function down()
  {
    Schema::dropIfExists('account_receivables');
  }
};
