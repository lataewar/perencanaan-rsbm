<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use stdClass;

class PermissionRepository extends BaseRepository
{
  public function __construct(Permission $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->query();
  }

  public function store(stdClass $request): Permission
  {
    return $this->model->create([
      'name' => $request->name,
    ]);
  }

  public function update(int $id, stdClass $request): Permission
  {
    $model = $this->find($id);
    return tap($model)->update([
      'name' => $request->name,
    ]);
  }

  public function getAllPluck(): Collection
  {
    return $this->model->pluck('name');
  }
}
