<?php

namespace Database\Seeders;

use App\Models\JenisBelanja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JenbelSeeder extends Seeder
{
  public function run(): void
  {
    // ------------------------------  ------------------------------ //

    JenisBelanja::insert([
      [
        'id' => Str::uuid(),
        'jb_kode' => '5.2.2',
        'jb_fullkode' => '5.2.2',
        'jb_name' => 'Belanja Barang dan Jasa',
        'jb_desc' => 'Belanja Barang dan Jasa',
        'jb_level' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'jb_kode' => '5.2.3',
        'jb_fullkode' => '5.2.3',
        'jb_name' => 'Belanja Modal',
        'jb_desc' => 'Belanja Modal',
        'jb_level' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);

  }
}