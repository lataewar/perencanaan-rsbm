<?php

namespace App\Repositories;

use App\Models\Belanja;
use App\Models\Usulan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

  public function store(stdClass $request): bool
  {
    DB::beginTransaction();

    try {
      $belanja = $this->model->where('perencanaan_id', $request->perencanaan_id)->where('jenis_belanja_id', $request->jenis_belanja_id)->firstOrCreate([
        'perencanaan_id' => $request->perencanaan_id,
        'jenis_belanja_id' => $request->jenis_belanja_id,
        'user_id' => auth()->user()->id,
      ]);
      $belanja->barangs()->attach(
        $request->barang_id,
        [
          'jumlah' => $request->jumlah,
          'harga' => $request->harga,
          'desc' => $request->desc,
          'is_exist' => $request->is_exist,
          'message' => $request->message,
          'sumber_anggaran' => $request->sumber_anggaran,
          'skala_prioritas' => $request->skala_prioritas,
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

  public function storeByUsulan(stdClass $request): bool
  {
    DB::beginTransaction();

    try {
      $belanja = $this->model->where('perencanaan_id', $request->perencanaan_id)->where('jenis_belanja_id', $request->jenis_belanja_id)->firstOrCreate([
        'perencanaan_id' => $request->perencanaan_id,
        'jenis_belanja_id' => $request->jenis_belanja_id,
        'user_id' => auth()->user()->id,
      ]);
      $belanja->barangs()->attach(
        $request->barang_id,
        [
          'jumlah' => $request->jumlah,
          'harga' => $request->harga,
          'desc' => $request->desc,
          'is_exist' => $request->is_exist,
          'message' => $request->message,
          'sumber_anggaran' => $request->sumber_anggaran,
          'skala_prioritas' => $request->skala_prioritas,
          'usulan_id' => $request->usulan_id,
          'user_id' => auth()->user()->id,
        ]
      );

      Usulan::find($request->usulan_id)->update(['is_accommodated' => true]);

      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
  }

  public function delete_pivot(string|array $barang, string $belanja, ?string $usulan): bool
  {
    DB::beginTransaction();

    try {
      $belanja = $this->find($belanja);
      $belanja->barangs()->detach($barang);

      if ($usulan)
        Usulan::find($usulan)->update(['is_accommodated' => false]);

      if ($belanja->barangs()->count() == 0)
        $belanja->delete();

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
          'sumber_anggaran' => $request->sumber_anggaran,
          'skala_prioritas' => $request->skala_prioritas,
        ]
      );
      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
  }

}
