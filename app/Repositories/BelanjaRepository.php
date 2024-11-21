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
          'ruangan_id' => $request->ruangan_id ?? null,
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

  private function delete_barang(string|int $pivot_id, ?string $usulan): void
  {
    DB::table('barang_belanja')->where('id', $pivot_id)->delete();

    if ($usulan)
      Usulan::find($usulan)->update(['is_accommodated' => false]);
  }

  public function delete_pivot(string|int $pivot_id, string $belanja, ?string $usulan): bool
  {
    DB::beginTransaction();

    try {
      $belanja = $this->find($belanja);

      $this->delete_barang($pivot_id, $usulan);

      if ($belanja->barangs()->count() == 0)
        $belanja->delete();

      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
  }

  public function delete_belanja(string|int $perencanaan_id): bool
  {
    DB::beginTransaction();

    try {

      $belanja = $this->model->where('perencanaan_id', $perencanaan_id)->first();

      $belanjas = DB::table('barang_belanja')->where('belanja_id', $belanja->id)->get();
      $belanjas->each(function ($item) {
        $this->delete_barang($item->id, $item->usulan_id);
      });

      $belanja->delete();

      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
  }

  public function find_pivot(string|int $pivot): ?stdClass
  {
    return DB::table('barang_belanja')
      ->select([
        'barang_belanja.*',
        'barangs.br_name',
      ])
      ->join('barangs', 'barangs.id', '=', 'barang_belanja.barang_id')
      ->where('barang_belanja.id', $pivot)->first();
  }

  public function update_pivot(string|int $pivot, stdClass $request): bool
  {
    DB::beginTransaction();

    try {
      DB::table('barang_belanja')->where('id', $pivot)->update([
        'jumlah' => $request->jumlah,
        'harga' => $request->harga,
        'desc' => $request->desc,
        'sumber_anggaran' => $request->sumber_anggaran,
        'skala_prioritas' => $request->skala_prioritas,
      ]);

      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
  }

}
