<?php

namespace App\Repositories;

use App\Models\Usulan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class UsulanRepository extends BaseRepository
{
  public function __construct(Usulan $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(string $id): Builder|Model
  {
    return $this->model->where('perencanaan_id', $id);
  }

  public function store(stdClass $request): Usulan
  {
    return $this->model->create([
      'unit_id' => auth()->user()->unit_id,
      'perencanaan_id' => $request->perencanaan_id,
      'ul_name' => $request->ul_name,
      'ul_prise' => $request->ul_prise,
      'ul_qty' => $request->ul_qty,
      'ul_desc' => $request->ul_desc,
    ]);
  }

  public function update(string $id, stdClass $request): Usulan
  {
    $model = $this->find($id);
    return tap($model)->update([
      'ul_name' => $request->ul_name,
      'ul_prise' => $request->ul_prise,
      'ul_qty' => $request->ul_qty,
      'ul_desc' => $request->ul_desc,
    ]);
  }
}
