<?php

namespace App\Services;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Repositories\MenuRepository;

class MenuService extends BaseService
{
  public function __construct(
    protected MenuRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function store(MenuRequest $request): Menu
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, MenuRequest $request): Menu
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }
}
