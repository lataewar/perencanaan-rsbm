<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Contracts\Role as RoleContract;
use stdClass;

class RoleRepository extends BaseRepository
{
  public function __construct(Role $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder|Model
  {
    return $this->model->withCount(['menus', 'permissions']);
  }

  public function findSpatieRole(int $id): RoleContract
  {
    return SpatieRole::findById($id);
  }

  public function getSpatiePermission(int $id): Collection
  {
    $role = $this->findSpatieRole($id);
    return $role->permissions()->pluck('name');
  }

  public function syncSpatiePermission(int $id, array $permissions): RoleContract
  {
    $role = $this->findSpatieRole($id);
    return $role->syncPermissions($permissions);
  }

  public function store(stdClass $request): Role
  {
    return $this->model->create([
      'name' => $request->name,
      'guard_name' => 'web',
      'desc' => $request->desc,
    ]);
  }

  public function update(int $id, stdClass $request): Role
  {
    return tap($this->find($id))->update([
      'name' => $request->name,
      'desc' => $request->desc,
    ]);
  }

  public function findByIdWithMenus(int $id): ?Role
  {
    return $this->model->with([
      'menus' => function ($query) {
        $query->select('name', 'id');
      }
    ])->where('id', $id)->get()->first();
  }

  public function syncMenus(int $id, array $menus): array
  {
    $model = $this->model->find($id);
    return $model->menus()->sync($menus);
  }
}
