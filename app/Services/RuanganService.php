<?php

namespace App\Services;

use App\Repositories\RuanganRepository;
use Illuminate\Database\Eloquent\Collection;

class RuanganService extends BaseService
{
  public function __construct(
    protected RuanganRepository $repository
  ) {
    parent::__construct($repository);
  }

  public function select_by_unit(string $unit): Collection
  {
    return $this->repository->select_by_unit($unit);
  }

}
