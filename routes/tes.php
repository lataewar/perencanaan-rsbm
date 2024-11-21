<?php

use App\Enums\StatusEnum;
use App\Models\AlkesFormat;
use App\Models\Belanja;
use App\Models\JenisBelanja;
use App\Models\Perencanaan;
use App\Models\Ruangan;
use App\Models\Status;
use App\Models\Unit;
use App\Models\User;
use App\Repositories\BelanjaRepository;
use App\Repositories\PerencanaanRepository;
use App\Services\PeriodeService;
use App\Services\RuanganService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::get('/tes', function () {

  $perencanaan_id = '9d436afc-d9fa-489a-9955-933c8dcd81c7';

  DB::beginTransaction();

  try {

    $belanja = Belanja::where('perencanaan_id', $perencanaan_id)->first();

    $belanjas = DB::table('barang_belanja')->where('belanja_id', $belanja->id)->get();

    $belanjas->each(function ($item) {
      // app(BelanjaRepository::class)->delete_barang($item->id, $item->usulan_id);
    });

    $belanja->delete();


    DB::commit();





    return "true";




  } catch (\Exception $e) {
    DB::rollback();
    return "false";
  }
});
