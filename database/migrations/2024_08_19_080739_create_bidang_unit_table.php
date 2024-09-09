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
    Schema::create('bidang_unit', function (Blueprint $table) {
      $table->foreignUuid('bidang_id')->constrained('bidangs')->cascadeOnDelete();
      $table->foreignUuid('unit_id')->constrained('units')->cascadeOnDelete();
      $table->primary(['bidang_id', 'unit_id']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('bidang_unit');
  }
};
