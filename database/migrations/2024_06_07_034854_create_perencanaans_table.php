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
      $table->tinyInteger('p_periode')->nullable();
      $table->tinyInteger('p_status');
      $table->foreignUuid('unit_id')->constrained('units');
      $table->foreignUuid('user_id')->constrained('users');
      $table->timestamps();
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
