<?php

namespace App\Repositories;

use App\Models\Periode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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

  public function all(): Collection
  {
    return $this->model->select(['id', 'u_name as name'])->get();
  }
}
