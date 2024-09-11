<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Ruangan::insert([
      [
        'r_name' => 'Unit Cath Lab',
        'unit_id' => 'bc51809b-fdef-4dab-9186-38a58a613208',
      ],
      [
        'r_name' => 'Ruang Lambu Barakati Lt.I (Kls.I)',
        'unit_id' => 'bc51809b-fdef-4dab-9186-38a58a613208',
      ],
      [
        'r_name' => 'Ruang Laika Morini VIP A (Super VIP)',
        'unit_id' => 'bc51809b-fdef-4dab-9186-38a58a613208',
      ],
      [
        'r_name' => 'Ruang Laika Mendidoha Lt.I (Kls.I)',
        'unit_id' => 'bc51809b-fdef-4dab-9186-38a58a613208',
      ],
    ]);
  }
}
