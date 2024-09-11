<?php

namespace App\Repositories;

use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Collection;

class RuanganRepository extends BaseRepository
{
  public function __construct(Ruangan $x_model)
  {
    parent::__construct($x_model);
  }

  public function all(): Collection
  {
    return $this->model->all();
  }

  public function select_by_unit(string $unit): Collection
  {
    return $this->model->where('unit_id', $unit)->select(['id', 'r_name as name'])->get();
  }

}
