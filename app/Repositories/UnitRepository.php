<?php

namespace App\Repositories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class UnitRepository extends BaseRepository
{
  public function __construct(Unit $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->query();
  }

  public function store(stdClass $request): Unit
  {
    return $this->model->create([
      'u_name' => $request->u_name,
      'u_kode' => $request->u_kode,
      'u_desc' => $request->u_desc,
    ]);
  }

  public function update(string $id, stdClass $request): Unit
  {
    $model = $this->find($id);
    return tap($model)->update([
      'u_name' => $request->u_name,
      'u_kode' => $request->u_kode,
      'u_desc' => $request->u_desc,
    ]);
  }

  public function all(): Collection
  {
    return $this->model->select(['id', 'u_name as name'])->get();
  }

  public function get_count(): int
  {
    return $this->model->count();
  }
}
