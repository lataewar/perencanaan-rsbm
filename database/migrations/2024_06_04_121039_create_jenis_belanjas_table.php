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
    Schema::create('jenis_belanjas', function (Blueprint $table) {
      $table->id();
      $table->string('jb_name', 100);
      $table->string('jb_kode', 20);
      $table->string('jb_fullkode', 50);
      $table->integer('jb_level')->nullable();
      $table->text('jb_desc')->nullable();
      // $table->foreignId('jenis_belanja_id')->nullable();
      $table->timestamps();
    });

    Schema::table('jenis_belanjas', function (Blueprint $table) {
      $table->foreignId('jenis_belanja_id')->nullable()->constrained('jenis_belanjas');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('jenis_belanjas');
  }
};
