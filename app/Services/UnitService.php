<?php

namespace App\Services;

use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use App\Repositories\UnitRepository;

class UnitService extends BaseService
{
  public function __construct(
    protected UnitRepository $repository
  ) {
    parent::__construct($repository);
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
}
