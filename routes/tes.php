<?php

use App\Enums\StatusEnum;
use App\Models\AlkesFormat;
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
  $csv_file = File::get(base_path("database/data/alkes.csv"));

  $lines = explode("\n", $csv_file);

  // dd($lines);

  $header = collect(str_getcsv(array_shift($lines), ';'));

  // return $header;

  $rows = collect($lines);

  $datas = $rows->map(fn($row) => $header->combine(str_getcsv($row, ';')));

  // return $datas;

  $mark_1 = null;
  $mark_2 = null;
  $mark_3 = null;
  foreach ($datas as $d) {
    //
    if ($d['mark'] == '*') {
      $mark_1 = $d['mark_1'];
    } else if ($d['mark'] == '**') {
      $mark_2 = $d['mark_2'];
    } else if ($d['mark'] == '***') {
      $mark_3 = $d['mark_3'];
    } else {
      AlkesFormat::insert([
        "mark_1" => $mark_1,
        "mark_2" => $mark_2,
        "mark_3" => $mark_3,
        "kode_mark" => $d['mark'],
        "kode" => $d['mark_3'],
        "name" => $d['name'],
        "ada" => $d['ada'],
        "no_seri" => $d['no_seri'],
        "merk" => $d['merk'],
        "type" => $d['type'],
        "thn_pengadaan" => $d['thn_pengadaan'],
        "thn_operasional" => $d['thn_operasional'],
        "berfungsi" => $d['berfungsi'],
        "kalibrasi" => $d['kalibrasi'],
        "harga" => $d['harga'],
        "pendanaan" => $d['pendanaan'],
        "distributor" => $d['distributor'],
        "akl_akd" => $d['akl_akd'],
        "keterangan" => $d['keterangan'],
      ]);
    }
  }
});
