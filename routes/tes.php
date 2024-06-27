<?php

use App\Enums\StatusEnum;
use App\Models\Belanja;
use App\Models\JenisBelanja;
use App\Models\Perencanaan;
use App\Models\Status;
use App\Models\Unit;
use App\Models\User;
use App\Repositories\BelanjaRepository;
use App\Repositories\PerencanaanRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::get('/tes', function () {



  // Storage::disk('local')->put('example.txt', 'Contents');

  // $csv_file = File::get('tes.csv');
  $csv_file = File::get(base_path("database/data/koderek.csv"));

  // $fileContents = file('tes.csv');

  // foreach ($fileContents as $line) {
  //   $data = str_getcsv($line);

  //   dump($data);
  // }

  // 1. Split by new line. Use the PHP_EOL constant for cross-platform compatibility.
  $lines = explode(PHP_EOL, $csv_file);

  // 2. Extract the header and convert it into a Laravel collection.
  $header = collect(str_getcsv(array_shift($lines), ';'));

  // return $header;

  // 3. Convert the rows into a Laravel collection.
  $rows = collect($lines);

  // return $rows;

  // 4. Map through the rows and combine them with the header to produce the final collection.
  $datas = $rows->map(fn($row) => $header->combine(str_getcsv($row, ';')));

  $id_1 = null;
  $fk_1 = null;
  $id_2 = null;
  $fk_2 = null;
  $jb_collection = new Collection();
  foreach ($datas as $d) {
    //
    if ($d['k1'] && $d['k2']) {

      if (!$d['k5'] && !$d['k6']) { // Jika Jenis_belanja level = 1
        $id_1 = Str::uuid();
        $fk_1 = $d['k1'] . '.' . $d['k2'] . '.' . $d['k3'] . '.' . $d['k4'];
        // $jb_collection->push([
        //   'id' => $id_1,
        //   'jb_name' => $d['name'],
        //   'jb_desc' => $d['name'],
        //   'jb_kode' => $d['k1'] . '.' . $d['k2'] . '.' . $d['k3'] . '.' . $d['k4'],
        //   'jb_fullkode' => $fk_1,
        //   'jb_level' => 1,
        // ]);
        JenisBelanja::insert([
          'id' => $id_1,
          'jb_name' => $d['name'],
          'jb_desc' => $d['name'],
          'jb_kode' => $d['k1'] . '.' . $d['k2'] . '.' . $d['k3'] . '.' . $d['k4'],
          'jb_fullkode' => $fk_1,
          'jb_level' => 1,
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      } else if (!$d['k6']) { // Jika Jenis_belanja level = 2
        $id_2 = Str::uuid();
        $fk_2 = $fk_1 . '.' . $d['k5'];
        // $jb_collection->push([
        //   'id' => $id_2,
        //   'jb_name' => $d['name'],
        //   'jb_desc' => $d['name'],
        //   'jb_kode' => $d['k5'],
        //   'jb_fullkode' => $fk_2,
        //   'jb_level' => 2,
        //   'jenis_belanja_id' => $id_1,
        // ]);
        JenisBelanja::insert([
          'id' => $id_2,
          'jb_name' => $d['name'],
          'jb_desc' => $d['name'],
          'jb_kode' => $d['k5'],
          'jb_fullkode' => $fk_2,
          'jb_level' => 2,
          'jenis_belanja_id' => $id_1,
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      } else { // Jika Jenis_belanja level = 3
        // $jb_collection->push([
        //   'id' => Str::uuid(),
        //   'jb_name' => $d['name'],
        //   'jb_desc' => $d['name'],
        //   'jb_kode' => $d['k6'],
        //   'jb_fullkode' => $fk_2 . '.' . $d['k6'],
        //   'jb_level' => 3,
        //   'jenis_belanja_id' => $id_2,
        // ]);
        JenisBelanja::insert([
          'id' => Str::uuid(),
          'jb_name' => $d['name'],
          'jb_desc' => $d['name'],
          'jb_kode' => $d['k6'],
          'jb_fullkode' => $fk_2 . '.' . $d['k6'],
          'jb_level' => 3,
          'jenis_belanja_id' => $id_2,
          'created_at' => now(),
          'updated_at' => now(),
        ]);
      }
    }
  };

  return $jb_collection;


  // $csv_file = File::get(base_path("database/data/koderek.csv"));
  // $csv_file = fopen(base_path("database/data/koderek.csv"), "r");

  // dd($csv_file);
});
