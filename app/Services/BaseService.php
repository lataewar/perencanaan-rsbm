<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
  /**
   * Create a new class instance.
   */
  public function __construct(
    protected $repo
  ) {
  }

  public function find(string|int $id): ?Model
  {
    return $this->repo->find($id);
  }

  public function getAll(): Collection
  {
    return $this->repo->all();
  }

  public function delete(string|int $id): bool
  {
    return $this->repo->delete($id);
  }

  public function multipleDelete(array $ids): bool
  {
    return $this->repo->multipleDelete($ids);
  }
}
