<?php

use App\Enums\StatusEnum;
use App\Models\Belanja;
use App\Models\Perencanaan;
use App\Models\Status;
use App\Repositories\BelanjaRepository;
use App\Repositories\PerencanaanRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::get('/tes', function () {

  // $str = "satu-x-dua";
  // return explode("-x-", $str);

  // $model = app(PerencanaanRepository::class)->table()->first()->status;
  // return StatusEnum::from($model)->getLabelHTML();
  // dump($enum);

  $status = Status::first()->status->getLabelHTML();
  // $status = Status::create([
  //   'perencanaan_id' => '26523c2f-5710-498f-b135-798a2692ab9e',
  //   'user_id' => auth()->user()->id,
  //   'status' => StatusEnum::DIKIRIM->value,
  //   'message' => 'Coba',
  // ]);

  return $status;

});

/*


*/
