<?php

namespace App\Services;

use App\Http\Requests\SubMenuRequest;
use App\Models\SubMenu;
use App\Repositories\SubMenuRepository;

class SubMenuService extends BaseService
{
  public function __construct(
    protected SubMenuRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function store(SubMenuRequest $request): SubMenu
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update($id, SubMenuRequest $request): SubMenu
  {
    return $this->repository->update(
      $id,
      (object) $request->validated()
    );
  }

  public function delete($id): bool
  {
    return $this->repository->delete($id);
  }
}
