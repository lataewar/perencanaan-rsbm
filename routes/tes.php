<?php

use App\Models\Perencanaan;
use App\Repositories\BelanjaRepository;
use App\Repositories\PerencanaanRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::get('/tes', function () {

  // $str = "satu-x-dua";
  // return explode("-x-", $str);

  $model = app(BelanjaRepository::class)->detail_belanja('x')->first();

  // return $model->total_barang();
  dd($model->total_barang);
  // return $model->barangs->reduce(function ($carry, $barang) {
  //   return $carry + $barang->pivot->jumlah * $barang->pivot->harga;
  // }, 0);
  ;

});

/*


*/
