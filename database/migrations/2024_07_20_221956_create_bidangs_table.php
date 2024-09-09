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
    Schema::create('bidangs', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('b_name', 100);
      $table->string('b_kode', 50)->nullable();
      $table->text('b_desc')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('bidangs');
  }
};
