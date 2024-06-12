<?php

namespace App\Services;

use App\Http\Requests\BarangRequest;
use App\Http\Requests\DetailBelanjaRequest;
use App\Models\Barang;
use App\Repositories\BelanjaRepository;
use Illuminate\Database\Eloquent\Collection;

class DetailBelanjaService extends BaseService
{
  public function __construct(
    protected BelanjaRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function store(DetailBelanjaRequest $request): BelanjaRepository
  {
    return $this->repository->store_barang((object) $request->validated());
  }

  public function update(string $id, DetailBelanjaRequest $request): BelanjaRepository
  {
    $validated = (object) $request->validated();
    return $this->repository->update_barang($id, $validated);
  }

  public function delete(string|int $id): bool
  {
    return $this->repository->delete_barang($id);
  }

}
