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
    Schema::create('periodes', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->year('w_tahun');
      $table->tinyInteger('w_periode');
      $table->date('w_date_start');
      $table->date('w_date_end');
      $table->timestamps();

      $table->unique(['w_tahun', 'w_periode']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('periodes');
  }
};
