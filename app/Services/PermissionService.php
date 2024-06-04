<?php

namespace App\Services;

use App\Http\Requests\PermissionRequest;
use App\Repositories\PermissionRepository;
use Spatie\Permission\Models\Permission;

class PermissionService extends BaseService
{
  public function __construct(
    protected PermissionRepository $repository,
  ) {
    parent::__construct($repository);
  }

  public function store(PermissionRequest $request): Permission
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, PermissionRequest $request): Permission
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }
}
