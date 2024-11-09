<?php

use App\Models\Country;
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
    Schema::create('states', function (Blueprint $table) {
      $table->id();
      $table->timestamps();

      $table->string('nome', 50);
      $table->char('uf', 2);
      $table->boolean('ativo')->default(true);

      $table->foreignIdFor(Country::class, 'country_id')->constrained()->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('states');
  }
};
