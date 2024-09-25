<?php

namespace App\Repositories;

use App\Models\Bidang;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class BidangRepository extends BaseRepository
{
  public function __construct(Bidang $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder|Model
  {
    return $this->model->withCount(['units']);
  }

  public function all(): Collection
  {
    return $this->model->select(['id', 'b_name as name'])->get();
  }

  public function withUnits(int|string $id): Bidang
  {
    return $this->model->with('units')->where('id', $id)->first();
  }

  public function syncUnits(int|string $id, array $units): array
  {
    $model = $this->model->find($id);
    return $model->units()->sync($units);
  }

  public function store(stdClass $request): Bidang
  {
    return $this->model->create([
      'b_name' => $request->b_name,
      'b_kode' => $request->b_kode,
      'b_desc' => $request->b_desc,
    ]);
  }

  public function update(int|string $id, stdClass $request): Bidang
  {
    return tap($this->find($id))->update([
      'b_name' => $request->b_name,
      'b_kode' => $request->b_kode,
      'b_desc' => $request->b_desc,
    ]);
  }
}
