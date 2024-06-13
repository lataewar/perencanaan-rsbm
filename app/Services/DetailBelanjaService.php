<?php

namespace App\Services;

use App\Http\Requests\DetailBelanjaRequest;
use App\Repositories\BelanjaRepository;
use Illuminate\Database\Eloquent\Model;

class DetailBelanjaService extends BaseService
{
  public function __construct(
    protected BelanjaRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function find_pivot(string $barang, string $belanja): ?Model
  {
    return $this->repository->find_pivot($barang, $belanja);
  }

  public function store(string $id, DetailBelanjaRequest $request): bool
  {
    return $this->repository->store_pivot($id, (object) $request->validated());
  }

  public function update(string $barang, string $belanja, DetailBelanjaRequest $request): bool
  {
    $validated = (object) $request->validated();
    return $this->repository->update_pivot($barang, $belanja, $validated);
  }

  public function delete_pivot(string|array $barang, string $belanja): bool
  {
    return $this->repository->delete_pivot($barang, $belanja);
  }

}
