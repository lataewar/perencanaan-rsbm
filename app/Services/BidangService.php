<?php

namespace App\Services;

use App\Http\Requests\BidangRequest;
use App\Models\Bidang;
use App\Repositories\BidangRepository;
use App\Repositories\UnitRepository;

class BidangService extends BaseService
{
  public function __construct(
    protected BidangRepository $repository,
  ) {
    parent::__construct($repository);
  }

  public function store(BidangRequest $request): Bidang
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int|string $id, BidangRequest $request): Bidang
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }

  public function delete(int|string $id): bool
  {
    return $this->repository->delete($id);
  }

  public function createUnits(int|string $id): array
  {
    $unitRepo = app(UnitRepository::class);
    return [
      'app' => (object) [
        'data' => $this->repository->withUnits($id),
        'units' => $unitRepo->all(),
      ]
    ];
  }

  public function syncUnits(int|string $id, array $units): array
  {
    return $this->repository->syncUnits($id, $units);
  }

}
