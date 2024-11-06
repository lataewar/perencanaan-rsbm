<?php

namespace App\Repositories;

use App\Models\Periode;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class PeriodeRepository extends BaseRepository
{
  public function __construct(Periode $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->query();
  }

  public function store(stdClass $request): Periode
  {
    return $this->model->create([
      'w_tahun' => $request->w_tahun,
      'w_periode' => $request->w_periode,
      'w_date_start' => $request->start,
      'w_date_end' => $request->end,
    ]);
  }

  public function update(string $id, stdClass $request): Periode
  {
    $model = $this->find($id);
    return tap($model)->update([
      'w_tahun' => $request->w_tahun,
      'w_periode' => $request->w_periode,
      'w_date_start' => $request->start,
      'w_date_end' => $request->end,
    ]);
  }

  public function getAllActive(): Collection
  {
    $today = Carbon::today();

    return $this->model
      ->select([
        'id',
        DB::raw("CONCAT(w_tahun, ' - ',w_periode) as name"),
      ])
      ->whereDate('w_date_start', '<=', $today)
      ->whereDate('w_date_end', '>=', $today)
      ->get();
  }

  public function checkIfActive(string $id): ?Periode
  {
    $today = Carbon::today();

    return $this->model
      ->where('id', $id)
      ->whereDate('w_date_start', '<=', $today)
      ->whereDate('w_date_end', '>=', $today)
      ->first();
  }

  public function checkIfActiveByTahunPeriode(string|int $tahun, string|int $periode): bool
  {
    $today = Carbon::today();

    return $this->model
      ->where('w_tahun', $tahun)
      ->where('w_periode', $periode)
      ->whereDate('w_date_start', '<=', $today)
      ->whereDate('w_date_end', '>=', $today)
      ->first()
      ? true : false;
  }
}
