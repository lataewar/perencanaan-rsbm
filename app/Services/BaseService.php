<?php

namespace App\Services;

class BaseService
{
  /**
   * Create a new class instance.
   */
  public function __construct(
    protected $repo
  ) {
  }

  public function delete(int $id): bool
  {
    return $this->repo->delete($id);
  }
}
