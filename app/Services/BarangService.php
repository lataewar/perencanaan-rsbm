<?php

namespace App\Services;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Repositories\BarangRepository;

class BarangService extends BaseService
{
  public function __construct(
    protected BarangRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function store(BarangRequest $request): Barang
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, BarangRequest $request): Barang
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }
}
