<?php

namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\Perencanaan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class PerencanaanRepository extends BaseRepository
{
  public function __construct(Perencanaan $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder|Model
  {
    return $this->model->with(['unit:id,u_name'])->orderBy('created_at');
  }

  public function find(int|string $id): ?Perencanaan
  {
    return $this->model->where('id', $id)->with(['unit', 'user'])->first();
  }

  public function store(stdClass $request): Perencanaan
  {
    return $this->model->create([
      'p_tahun' => $request->p_tahun,
      'p_periode' => $request->p_periode,
      'p_status' => StatusEnum::DRAFT->value,
      'user_id' => auth()->user()->id,
      'unit_id' => auth()->user()->unit_id,
    ]);
  }
}
