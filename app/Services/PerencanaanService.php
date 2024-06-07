<?php

namespace App\Services;

use App\Http\Requests\PerencanaanRequest;
use App\Models\Perencanaan;
use App\Repositories\PerencanaanRepository;

class PerencanaanService extends BaseService
{
  public function __construct(
    protected PerencanaanRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function store(PerencanaanRequest $request): Perencanaan
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(string $id, PerencanaanRequest $request): Perencanaan
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }
}
