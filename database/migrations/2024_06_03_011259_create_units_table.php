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
    Schema::create('units', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('u_name', 100);
      $table->string('u_kode', 50)->nullable();
      $table->text('u_desc')->nullable();
      $table->boolean('is_has_ruang')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('units');
  }
};
