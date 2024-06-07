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
    Schema::create('barangs', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('br_name', 150);
      $table->string('br_kode', 20)->nullable();
      $table->string('br_satuan', 50);
      $table->foreignUuid('jenis_belanja_id')->constrained('jenis_belanjas');
      $table->text('br_desc')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('barangs');
  }
};
