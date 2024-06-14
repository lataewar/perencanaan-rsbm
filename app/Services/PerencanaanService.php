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

  public function find_total(string $id): ?Perencanaan
  {
    return $this->repository->find_total($id);
  }

  public function getTahun(): array
  {
    $arrays = array();
    for ($i = 0; $i < 10; $i++) {
      array_push($arrays, [
        'id' => 2024 + $i,
        'name' => 2024 + $i,
      ]);
    }
    return $arrays;
  }
}
