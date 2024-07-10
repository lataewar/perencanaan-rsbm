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
    Schema::create('barang_belanja', function (Blueprint $table) {
      $table->foreignUuid('barang_id')->constrained('barangs');
      $table->foreignUuid('belanja_id')->constrained('belanjas');
      $table->foreignUuid('usulan_id')->nullable();
      $table->integer('jumlah');
      $table->bigInteger('harga');
      $table->text('desc')->nullable();
      $table->boolean('is_exist')->default(false);
      $table->string('message')->nullable();
      $table->tinyInteger('sumber_anggaran')->nullable();
      $table->enum('skala_prioritas', ['ya', 'tidak'])->nullable();
      $table->foreignUuid('user_id')->constrained('users');
      $table->timestamps();

      $table->primary(['barang_id', 'belanja_id']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('barang_belanja');
  }
};
