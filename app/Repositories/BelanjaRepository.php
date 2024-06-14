<?php

namespace App\Repositories;

use App\Models\Belanja;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use stdClass;

class BelanjaRepository extends BaseRepository
{
  public function __construct(Belanja $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(string $id): Collection
  {
    return $this->model
      ->select([
        'belanjas.*',

        'jb3.id as jb3_id',
        'jb3.jb_name as jb3_name',
        'jb3.jb_kode as jb3_kode',
        'jb3.jb_fullkode as jb3_fullkode',
        'jb3.jb_level as jb3_level',

        'jb2.id as jb2_id',
        'jb2.jb_name as jb2_name',
        'jb2.jb_kode as jb2_kode',
        'jb2.jb_fullkode as jb2_fullkode',
        'jb2.jb_level as jb2_level',

        'jb1.id as jb1_id',
        'jb1.jb_name as jb1_name',
        'jb1.jb_kode as jb1_kode',
        'jb1.jb_fullkode as jb1_fullkode',
        'jb1.jb_level as jb1_level',
      ])
      ->join('jenis_belanjas as jb3', 'jb3.id', '=', 'belanjas.jenis_belanja_id', 'left')
      ->join('jenis_belanjas as jb2', 'jb2.id', '=', 'jb3.jenis_belanja_id', 'left')
      ->join('jenis_belanjas as jb1', 'jb1.id', '=', 'jb2.jenis_belanja_id', 'left')
      ->with(['barangs'])
      ->where('belanjas.perencanaan_id', $id)
      ->orderBy('jb3.jb_fullkode')
      ->get();
  }

  public function store(stdClass $request): Belanja
  {
    return $this->model->create([
      'perencanaan_id' => $request->perencanaan_id,
      'jenis_belanja_id' => $request->jenis_belanja_id,
      'b_desc' => $request->b_desc,
      'user_id' => auth()->user()->id,
    ]);
  }

  public function detail_belanja(string $id): Model
  {
    $id = Session::get('belanja_id');
    // dd($id);
    return $this->model
      ->select([
        'belanjas.*',
        'jb3.jb_name as jb3_name',
        'jb3.jb_fullkode as jb3_fullkode',
        'jb2.jb_name as jb2_name',
        'jb2.jb_fullkode as jb2_fullkode',
        'jb1.jb_name as jb1_name',
        'jb1.jb_fullkode as jb1_fullkode',
      ])
      ->join('jenis_belanjas as jb3', 'jb3.id', '=', 'belanjas.jenis_belanja_id', 'left')
      ->join('jenis_belanjas as jb2', 'jb2.id', '=', 'jb3.jenis_belanja_id', 'left')
      ->join('jenis_belanjas as jb1', 'jb1.id', '=', 'jb2.jenis_belanja_id', 'left')
      ->with(['barangs'])
      ->where('belanjas.id', $id)
      ->first();
  }

  public function table_barangs(string $id): BelongsToMany
  {
    return $this->find($id)->barangs();
  }

  public function store_pivot(string $id, stdClass $request): bool
  {
    DB::beginTransaction();

    try {
      $belanja = $this->find($id);
      $belanja->barangs()->attach(
        $request->barang_id,
        [
          'jumlah' => $request->jumlah,
          'harga' => $request->harga,
          'desc' => $request->desc,
          'user_id' => auth()->user()->id,
        ]
      );
      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
  }

  public function find_pivot(string $barang, string $belanja): ?Model
  {
    return $this->find($belanja)->barangs()->find($barang);
  }

  public function update_pivot(string $barang, string $belanja, stdClass $request): bool
  {
    DB::beginTransaction();

    try {
      $belanja = $this->find($belanja);
      $belanja->barangs()->updateExistingPivot(
        $barang,
        [
          'jumlah' => $request->jumlah,
          'harga' => $request->harga,
          'desc' => $request->desc,
          'user_id' => auth()->user()->id,
        ]
      );
      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
  }

  public function delete_pivot(string|array $barang, string $belanja): bool
  {
    DB::beginTransaction();

    try {
      $belanja = $this->find($belanja);
      $belanja->barangs()->detach($barang);
      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
  }

}
