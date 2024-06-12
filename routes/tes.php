<?php

use App\Models\Perencanaan;
use App\Repositories\PerencanaanRepository;
use Illuminate\Support\Facades\Route;

Route::get('/tes', function () {
  // return Perencanaan::with('unit')->get();
  return app(PerencanaanRepository::class)->table()->get();

});

/*


*/
