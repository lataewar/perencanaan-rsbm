<?php

use App\Models\Belanja;
use App\Models\Perencanaan;
use App\Repositories\BelanjaRepository;
use App\Repositories\PerencanaanRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::get('/tes', function () {

  // $str = "satu-x-dua";
  // return explode("-x-", $str);

  $model = app(PerencanaanRepository::class)->table()->get();

  return $model;

});

/*


*/
