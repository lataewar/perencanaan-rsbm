<?php

namespace App\Services;

use App\Http\Requests\PeriodeRequest;
use App\Models\Periode;
use App\Repositories\PeriodeRepository;
use Illuminate\Database\Eloquent\Collection;

class PeriodeService extends BaseService
{
  public function __construct(
    protected PeriodeRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function getAll(): Collection
  {
    return $this->repo->all();
  }

  public function store(PeriodeRequest $request): Periode
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(string $id, PeriodeRequest $request): Periode
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }

}