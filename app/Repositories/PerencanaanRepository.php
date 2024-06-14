<?php

namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\Perencanaan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use stdClass;

class PerencanaanRepository extends BaseRepository
{
  public function __construct(Perencanaan $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder|Model
  {
    return $this->model
      ->select(
        [
          'perencanaans.id',
          'perencanaans.p_tahun',
          'perencanaans.p_periode',
          'perencanaans.p_status',
          'perencanaans.created_at',

          'u.u_name',

          DB::raw('SUM(bb.jumlah * bb.harga) as total'),
        ]
      )
      ->join('units as u', 'u.id', '=', 'perencanaans.unit_id')
      ->join('belanjas as bl', 'bl.perencanaan_id', '=', 'perencanaans.id', 'left')
      ->join('barang_belanja as bb', 'bb.belanja_id', '=', 'bl.id', 'left')
      ->join('barangs as br', 'br.id', '=', 'bb.barang_id', 'left')
      ->groupBy(['perencanaans.id', 'perencanaans.p_tahun', 'perencanaans.p_periode', 'perencanaans.p_status', 'perencanaans.created_at', 'u.u_name',])
      ->orderBy('perencanaans.created_at');
    // return $this->model->with(['unit:id,u_name'])->orderBy('created_at');
  }

  public function find_total(string $id): ?Perencanaan
  {
    return $this->model
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
      ->join('belanjas as bl', 'bl.perencanaan_id', '=', 'perencanaans.id', 'left')
      ->join('barang_belanja as bb', 'bb.belanja_id', '=', 'bl.id', 'left')
      ->join('barangs as br', 'br.id', '=', 'bb.barang_id', 'left')
      ->where('perencanaans.id', $id)
      ->groupBy(['perencanaans.id', 'perencanaans.p_tahun', 'perencanaans.p_periode', 'perencanaans.p_status', 'u.u_name',])
      ->first();
  }

  public function store(stdClass $request): Perencanaan
  {
    return $this->model->create([
      'p_tahun' => $request->p_tahun,
      'p_periode' => $request->p_periode,
      'p_status' => StatusEnum::DRAFT->value,
      'user_id' => auth()->user()->id,
      'unit_id' => auth()->user()->unit_id,
    ]);
  }
}
