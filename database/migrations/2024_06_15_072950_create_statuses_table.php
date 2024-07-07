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
    Schema::create('statuses', function (Blueprint $table) {
      $table->id();
      $table->foreignUuid('perencanaan_id')->constrained('perencanaans')->cascadeOnDelete();
      $table->foreignUuid('user_id');
      $table->tinyInteger('status');
      $table->string('message')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('statuses');
  }
};
