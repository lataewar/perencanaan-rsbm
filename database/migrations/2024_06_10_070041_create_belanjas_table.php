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
    Schema::create('belanjas', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('perencanaan_id')->constrained('perencanaans');
      $table->foreignUuid('jenis_belanja_id')->constrained('jenis_belanjas');
      $table->tinyInteger('b_sumber_anggaran')->nullable();
      $table->foreignUuid('user_id')->constrained('users');
      $table->text('b_desc')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('belanjas');
  }
};
