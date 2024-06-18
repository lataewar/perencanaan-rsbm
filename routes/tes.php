<?php

use App\Enums\StatusEnum;
use App\Models\Belanja;
use App\Models\Perencanaan;
use App\Models\Status;
use App\Models\Unit;
use App\Models\User;
use App\Repositories\BelanjaRepository;
use App\Repositories\PerencanaanRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::get('/tes', function () {

  // $var = [];
  // for ($i = 0; $i < 20; $i++) {
  //   array_push($var, fake()->unique()->numberBetween($min = 1000, $max = 9000));
  // }
  // return $var;

  return User::where('role_id', 5)->get();

});
