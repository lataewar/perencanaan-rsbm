<?php

namespace App\Repositories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class BarangRepository extends BaseRepository
{
  public function __construct(Barang $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(?int $id): Builder|Model
  {
    return $this->model->where('jenis_belanja_id', $id);
  }

  public function store(stdClass $request): Barang
  {
    return $this->model->create([
      'br_name' => $request->br_name,
      'br_kode' => $request->br_kode,
      'br_desc' => $request->br_desc,
      'br_satuan' => $request->br_satuan,
      'jenis_belanja_id' => $request->jenis_belanja_id,
    ]);
  }

  public function update(int $id, stdClass $request): Barang
  {
    $model = $this->find($id);
    return tap($model)->update([
      'br_name' => $request->br_name,
      'br_kode' => $request->br_kode,
      'br_desc' => $request->br_desc,
      'br_satuan' => $request->br_satuan,
    ]);
  }
}
