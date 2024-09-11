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
    Schema::create('usulans', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('unit_id')->constrained('units');
      $table->foreignUuid('perencanaan_id')->constrained('perencanaans');
      $table->foreignId('ruangan_id')->nullable()->constrained('ruangans');
      $table->string('ul_name', 100);
      $table->bigInteger('ul_prise')->nullable();
      $table->integer('ul_qty');
      $table->text('ul_desc')->nullable();
      $table->boolean('is_accommodated')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('usulans');
  }
};
