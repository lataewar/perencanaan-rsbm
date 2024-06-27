<?php

namespace App\Repositories;

use App\Models\JenisBelanja;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class JenbelRepository extends BaseRepository
{
  public function __construct(JenisBelanja $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(?string $id): Builder|Model
  {
    return $this->model->where('jenis_belanja_id', $id)->orderBy('created_at');
  }

  public function store(stdClass $request): JenisBelanja
  {
    return $this->model->create([
      'jb_name' => $request->jb_name,
      'jb_kode' => $request->jb_kode,
      'jb_level' => $request->jb_level,
      'jb_fullkode' => $request->jb_fullkode,
      'jb_desc' => $request->jb_desc,
      'jenis_belanja_id' => $request->jenis_belanja_id,
    ]);
  }

  public function update(string $id, stdClass $request): JenisBelanja
  {
    $model = $this->find($id);
    return tap($model)->update([
      'jb_name' => $request->jb_name,
      'jb_desc' => $request->jb_desc,
    ]);
  }

  public function getAllByLevel(int $lvl): Collection
  {
    return $this->model->where('jb_level', $lvl)->orderBy('created_at')->get(['id', 'jb_name as name', 'jb_fullkode as fullkode', 'jb_kode as kode']);
  }
}
