<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('perencanaans', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->year('p_tahun');
      $table->tinyInteger('p_periode');
      $table->foreignUuid('unit_id')->constrained('units');
      $table->foreignUuid('user_id')->constrained('users');
      $table->timestamps();

      $table->unique(['p_tahun', 'p_periode', 'unit_id']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('perencanaans');
  }
};
