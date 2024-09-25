<?php

namespace App\Services;

use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use App\Repositories\UnitRepository;
use Illuminate\Database\Eloquent\Collection;

class UnitService extends BaseService
{
  public function __construct(
    protected UnitRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function getAll(): Collection
  {
    if (auth()->user()->role_id->isBidang())
      return $this->repo->get_all_by_bidang(auth()->user()->bidang_id);

    return $this->repo->all();
  }

  public function store(UnitRequest $request): Unit
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(string $id, UnitRequest $request): Unit
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }

  public function dashboard_get_count(): int
  {
    return $this->repository->get_count();
  }
}
