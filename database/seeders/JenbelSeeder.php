<?php

namespace Database\Seeders;

use App\Models\JenisBelanja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JenbelSeeder extends Seeder
{
  public function run(): void
  {
    // ------------------------------  ------------------------------ //

    $csv_file = File::get(base_path("database/data/koderek.csv"));

    // 1. Split by new line. Use the PHP_EOL constant for cross-platform compatibility.
    // $lines = explode(PHP_EOL, $csv_file);
    $lines = explode("\n", $csv_file);

    // 2. Extract the header and convert it into a Laravel collection.
    $header = collect(str_getcsv(array_shift($lines), ';'));
    // 3. Convert the rows into a Laravel collection.
    $rows = collect($lines);
    // 4. Map through the rows and combine them with the header to produce the final collection.
    $datas = $rows->map(fn($row) => $header->combine(str_getcsv($row, ';')));

    $id_1 = null;
    $fk_1 = null;
    $id_2 = null;
    $fk_2 = null;
    $minute = 1;
    foreach ($datas as $d) {
      //
      if ($d['k1'] && $d['k2']) {

        if (!$d['k5'] && !$d['k6']) { // Jika Jenis_belanja level = 1
          $id_1 = Str::uuid();
          $fk_1 = $d['k1'] . '.' . $d['k2'] . '.' . $d['k3'] . '.' . $d['k4'];
          JenisBelanja::insert([
            'id' => $id_1,
            'jb_name' => $d['name'],
            'jb_desc' => $d['name'],
            'jb_kode' => $d['k1'] . '.' . $d['k2'] . '.' . $d['k3'] . '.' . $d['k4'],
            'jb_fullkode' => $fk_1,
            'jb_level' => 1,
            'created_at' => now()->subDays(10)->addMinutes($minute),
            'updated_at' => now()->subDays(10)->addMinutes($minute),
          ]);
        } else if (!$d['k6']) { // Jika Jenis_belanja level = 2
          $id_2 = Str::uuid();
          $fk_2 = $fk_1 . '.' . $d['k5'];
          JenisBelanja::insert([
            'id' => $id_2,
            'jb_name' => $d['name'],
            'jb_desc' => $d['name'],
            'jb_kode' => $d['k5'],
            'jb_fullkode' => $fk_2,
            'jb_level' => 2,
            'jenis_belanja_id' => $id_1,
            'created_at' => now()->subDays(10)->addMinutes($minute),
            'updated_at' => now()->subDays(10)->addMinutes($minute),
          ]);
        } else { // Jika Jenis_belanja level = 3
          JenisBelanja::insert([
            'id' => Str::uuid(),
            'jb_name' => $d['name'],
            'jb_desc' => $d['name'],
            'jb_kode' => $d['k6'],
            'jb_fullkode' => $fk_2 . '.' . $d['k6'],
            'jb_level' => 3,
            'jenis_belanja_id' => $id_2,
            'created_at' => now()->subDays(10)->addMinutes($minute),
            'updated_at' => now()->subDays(10)->addMinutes($minute),
          ]);
        }
      }
      $minute++;
    }

  }
}
