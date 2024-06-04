<?php

namespace App\Services;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Repositories\MenuRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Spatie\Permission\Contracts\Role as RoleContract;

class RoleService extends BaseService
{
  public function __construct(
    protected RoleRepository $repository,
  ) {
    parent::__construct($repository);
  }

  public function findSpatieRole(int $id): RoleContract
  {
    return $this->repository->findSpatieRole($id);
  }

  public function store(RoleRequest $request): Role
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, RoleRequest $request): Role
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }

  public function delete(int $id): bool
  {
    return $this->repository->delete($id);
  }

  public function createAkses(int $id): array
  {
    $menuRepo = app(MenuRepository::class);
    return [
      'app' => (object) [
        'data' => $this->repository->findByIdWithMenus($id),
        'menus' => $menuRepo->all(),
      ]
    ];
  }

  public function syncAkses(int $id, array $menus): array
  {
    return $this->repository->syncMenus($id, $menus);
  }

  public function createPermission(int $id): array
  {
    return [
      'app' => (object) [
        'id' => $id,
        'data' => $this->repository->getSpatiePermission($id),
        'permissions' => app(PermissionRepository::class)->getAllPluck(),
      ]
    ];
  }

  public function syncPermission(int $id, array $permissions): RoleContract
  {
    return $this->repository->syncSpatiePermission($id, $permissions);
  }
}
