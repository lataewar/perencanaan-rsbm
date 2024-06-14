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

  $model = Perencanaan::query()
    ->select(
      [
        'perencanaans.id',
        'perencanaans.p_tahun',
        'perencanaans.p_periode',
        'perencanaans.p_status',

        'u.u_name',

        DB::raw('SUM(bb.jumlah * bb.harga) as total'),
      ]
    )
    ->join('units as u', 'u.id', '=', 'perencanaans.unit_id')
    ->join('belanjas as bl', 'bl.perencanaan_id', '=', 'perencanaans.id')
    ->join('barang_belanja as bb', 'bb.belanja_id', '=', 'bl.id')
    ->join('barangs as br', 'br.id', '=', 'bb.barang_id')
    ->where('perencanaans.id', Session::get('perencanaan_id'))
    ->groupBy(['perencanaans.id', 'perencanaans.p_tahun', 'perencanaans.p_periode', 'perencanaans.p_status', 'u.u_name',])
    ->get();

  return $model;

});

/*


*/
