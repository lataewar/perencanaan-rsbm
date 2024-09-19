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
use App\Services\RuanganService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::get('/tes', function () {
  // $ruangans = app(RuanganService::class)->getAll();

  // return $ruangans->find(2)->r_name ?? '';

  return auth()->user();
});
