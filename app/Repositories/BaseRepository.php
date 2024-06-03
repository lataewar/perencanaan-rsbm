<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseRepository
{
  public function __construct(
    protected Model $model
  ) {
  }

  public function find(int $id): ?Model
  {
    return $this->model->find($id);
  }

  public function delete(int $id): bool
  {
    $model = $this->find($id);
    return $model->delete();
  }

  public function multipleDelete(array $ids): bool
  {
    DB::beginTransaction();

    try {
      foreach ($ids as $id) {
        $this->delete($id);
      }
      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
  }
}
