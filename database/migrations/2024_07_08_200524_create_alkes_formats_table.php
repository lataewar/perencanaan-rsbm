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
    Schema::create('alkes_formats', function (Blueprint $table) {
      $table->id();
      $table->string('mark_1')->nullable();
      $table->string('mark_2')->nullable();
      $table->string('mark_3')->nullable();
      $table->string('kode_mark')->nullable();
      $table->string('kode')->nullable();
      $table->string('name')->nullable();
      $table->string('ada')->nullable();
      $table->string('no_seri')->nullable();
      $table->string('merk')->nullable();
      $table->string('type')->nullable();
      $table->string('thn_pengadaan')->nullable();
      $table->string('thn_operasional')->nullable();
      $table->string('berfungsi')->nullable();
      $table->string('kalibrasi')->nullable();
      $table->string('harga')->nullable();
      $table->string('pendanaan')->nullable();
      $table->string('distributor')->nullable();
      $table->string('akl_akd')->nullable();
      $table->string('keterangan')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   * No seri	Merk	Type	Thn Pengadaan	Thn Operasional	Berfungi	Kalibrasi	Harga	Pendanaan	Distributor	AKL/AKD	Keterangan
   */
  public function down(): void
  {
    Schema::dropIfExists('alkes_formats');
  }
};
