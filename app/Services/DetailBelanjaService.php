<?php

namespace App\Services;

use App\Http\Requests\BarangRequest;
use App\Http\Requests\DetailBelanjaRequest;
use App\Models\Barang;
use App\Models\Belanja;
use App\Repositories\BelanjaRepository;
use Illuminate\Database\Eloquent\Collection;

class DetailBelanjaService extends BaseService
{
  public function __construct(
    protected BelanjaRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function find_pivot(string $barang, string $belanja)//: Collection
  {
    return $this->repository->find_pivot($barang, $belanja);
  }

  public function store(string $id, DetailBelanjaRequest $request): bool
  {
    return $this->repository->store_pivot($id, (object) $request->validated());
  }

  public function update(string $id, DetailBelanjaRequest $request): Belanja
  {
    $validated = (object) $request->validated();
    return $this->repository->update_pivot($id, $validated);
  }

  public function delete(string|int $id): bool
  {
    return $this->repository->delete_pivot($id);
  }

}
