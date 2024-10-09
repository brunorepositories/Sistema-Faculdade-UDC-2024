<?php

use App\Models\State;
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
    Schema::create('cities', function (Blueprint $table) {
      $table->id();
      $table->timestamps();

      $table->string('nome', 50);
      $table->unsignedSmallInteger('ddd');

      $table->foreignIdFor(State::class, 'state_id')->constrained()->onDelete('Cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('cities');
  }
};
