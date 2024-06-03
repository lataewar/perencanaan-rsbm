<?php

namespace App\Services;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Database\Eloquent\Collection;

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

  // public function delete(int $id): bool
  // {
  //   return $this->repository->delete($id);
  // }

  public function getAll(): Collection
  {
    return $this->repository->all();
  }
}
