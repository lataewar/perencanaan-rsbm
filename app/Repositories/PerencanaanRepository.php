<?php

namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\Perencanaan;
use App\QueryFilters\Perencanaan\ByStatus;
use App\QueryFilters\Perencanaan\ByUnits;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Pipeline;
use stdClass;

class PerencanaanRepository extends BaseRepository
{
  public function __construct(Perencanaan $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): LengthAwarePaginator
  {
    $query = $this->model
      ->unit_scope()
      ->non_unit_scope()
      ->select(
        [
          'perencanaans.id',
          'perencanaans.p_tahun',
          'perencanaans.p_periode',
          'perencanaans.created_at',

          'statuses.status',
          'statuses.message',
          'statuses.created_at as st_created_at',

          'u.u_name',
          'u.id as u_id',

          DB::raw('SUM(bb.jumlah * bb.harga) as total'),

        ]
      )
      ->join('units as u', 'u.id', '=', 'perencanaans.unit_id')
      ->join('belanjas as bl', 'bl.perencanaan_id', '=', 'perencanaans.id', 'left')
      ->join('barang_belanja as bb', 'bb.belanja_id', '=', 'bl.id', 'left')
      ->join('barangs as br', 'br.id', '=', 'bb.barang_id', 'left')
      ->leftJoin('statuses', function ($query) {
        $query->on('statuses.perencanaan_id', '=', 'perencanaans.id')
          ->whereRaw('statuses.created_at IN (select MAX(statuses.created_at) from statuses join perencanaans on perencanaans.id = statuses.perencanaan_id group by perencanaans.id)');
      }) // get last data from proses
      ->groupBy(['perencanaans.id', 'perencanaans.p_tahun', 'perencanaans.p_periode', 'perencanaans.created_at', 'statuses.status', 'statuses.message', 'statuses.created_at', 'u.u_name', 'u.id'])
      ->orderBy('perencanaans.created_at');

    return Pipeline::send($query)
      ->through([
        ByUnits::class,
        ByStatus::class,
      ])
      ->thenReturn()
      ->paginate(session()->get('ptable.per_page') ?? 10);
  }

  public function find_total(string $id): ?Perencanaan
  {
    return $this->model
      ->unit_scope()
      ->select(
        [
          'perencanaans.id',
          'perencanaans.p_tahun',
          'perencanaans.p_periode',
          'perencanaans.created_at',

          'statuses.status',
          'statuses.message',
          'statuses.created_at as st_created_at',

          'u.u_name',
          'u.id as u_id',

          DB::raw('SUM(bb.jumlah * bb.harga) as total'),
        ]
      )
      ->join('units as u', 'u.id', '=', 'perencanaans.unit_id')
      ->join('belanjas as bl', 'bl.perencanaan_id', '=', 'perencanaans.id', 'left')
      ->join('barang_belanja as bb', 'bb.belanja_id', '=', 'bl.id', 'left')
      ->join('barangs as br', 'br.id', '=', 'bb.barang_id', 'left')
      ->leftJoin('statuses', function ($query) {
        $query->on('statuses.perencanaan_id', '=', 'perencanaans.id')
          ->whereRaw('statuses.created_at IN (select MAX(statuses.created_at) from statuses join perencanaans on perencanaans.id = statuses.perencanaan_id group by perencanaans.id)');
      }) // get last data from proses
      ->where('perencanaans.id', $id)
      ->groupBy(['perencanaans.id', 'perencanaans.p_tahun', 'perencanaans.p_periode', 'perencanaans.created_at', 'statuses.status', 'statuses.message', 'statuses.created_at', 'u.u_name', 'u.id'])
      ->first();
  }

  public function store(stdClass $request): Perencanaan
  {
    $perencanaan = $this->model->create([
      'p_tahun' => $request->p_tahun,
      'p_periode' => $request->p_periode,
      'user_id' => auth()->user()->id,
      'unit_id' => auth()->user()->unit_id,
    ]);
    $perencanaan->statuses()->create([
      'status' => StatusEnum::DRAFT->value,
      'message' => 'Draft usulan dibuat.',
      'user_id' => auth()->user()->id,
    ]);

    return $perencanaan;
  }

  public function update_status(string $id, int $status, string $msg): bool
  {
    DB::beginTransaction();
    try {
      $this->find($id)->statuses()->create([
        'status' => $status,
        'message' => $msg,
        'user_id' => auth()->user()->id,
      ]);
      DB::commit();
      return true;
    } catch (\Exception $e) {
      DB::rollback();
      return false;
    }
  }

  public function validate_isexist(string $barang_id, string $perencanaan_id): Collection
  {
    return $this->model
      ->select(['perencanaans.p_tahun'])
      ->join('belanjas as bl', 'bl.perencanaan_id', '=', 'perencanaans.id')
      ->join('barang_belanja as bb', 'bb.belanja_id', '=', 'bl.id')
      ->leftJoin('statuses', function ($query) {
        $query->on('statuses.perencanaan_id', '=', 'perencanaans.id')
          ->whereRaw('statuses.created_at IN (select MAX(statuses.created_at) from statuses join perencanaans on perencanaans.id = statuses.perencanaan_id group by perencanaans.id)');
      })
      ->where('bb.barang_id', $barang_id)
      ->where('perencanaans.unit_id', '=', function (Builder $query) use ($perencanaan_id) {
        $query->select('unit_id')
          ->from('perencanaans')
          ->where('id', $perencanaan_id);
      })
      ->where('statuses.status', StatusEnum::DISETUJUI->value)
      ->get();
  }

  public function get_count_by_year_and_status(int $year, int $status): int
  {
    return $this->model
      ->select(['perencanaans.id'])
      ->join('statuses', function ($query) {
        $query->on('statuses.perencanaan_id', '=', 'perencanaans.id')
          ->whereRaw('statuses.created_at IN (select MAX(statuses.created_at) from statuses join perencanaans on perencanaans.id = statuses.perencanaan_id group by perencanaans.id)');
      })
      ->where('perencanaans.p_tahun', $year)
      ->where('statuses.status', $status)
      ->get()->count();
  }

  public function get_count_by_unit_and_status(string $unit, int $status): int
  {
    return $this->model
      ->select(['perencanaans.id'])
      ->join('statuses', function ($query) {
        $query->on('statuses.perencanaan_id', '=', 'perencanaans.id')
          ->whereRaw('statuses.created_at IN (select MAX(statuses.created_at) from statuses join perencanaans on perencanaans.id = statuses.perencanaan_id group by perencanaans.id)');
      })
      ->where('perencanaans.unit_id', $unit)
      ->where('statuses.status', $status)
      ->get()->count();
  }

  public function usul_table(): LengthAwarePaginator
  {
    $query = $this->model
      ->unit_scope()
      ->select(
        [
          'perencanaans.id',
          'perencanaans.p_tahun',
          'perencanaans.p_periode',
          'perencanaans.created_at',

          'statuses.status',
          'statuses.message',
          'statuses.created_at as st_created_at',

          'u.u_name',
          'u.id as u_id',
        ]
      )
      ->join('units as u', 'u.id', '=', 'perencanaans.unit_id')
      ->leftJoin('statuses', function ($query) {
        $query->on('statuses.perencanaan_id', '=', 'perencanaans.id')
          ->whereRaw('statuses.created_at IN (select MAX(statuses.created_at) from statuses join perencanaans on perencanaans.id = statuses.perencanaan_id group by perencanaans.id)');
      }) // get last data from proses
      ->withCount('usulans')
      ->groupBy(['perencanaans.id', 'perencanaans.p_tahun', 'perencanaans.p_periode', 'perencanaans.created_at', 'statuses.status', 'statuses.message', 'statuses.created_at', 'u.u_name', 'u.id'])
      ->orderBy('perencanaans.created_at');

    return Pipeline::send($query)
      ->through([
        \App\QueryFilters\Usulan\ByStatus::class,
      ])
      ->thenReturn()
      ->paginate(session()->get('utable.per_page') ?? 10);
  }

  public function find_usulan(string $id): ?Perencanaan
  {
    return $this->model
      ->unit_scope()
      ->select(
        [
          'perencanaans.id',
          'perencanaans.p_tahun',
          'perencanaans.p_periode',
          'perencanaans.created_at',

          'statuses.status',
          'statuses.message',
          'statuses.created_at as st_created_at',

          'u.u_name',
          'u.id as u_id',
        ]
      )
      ->join('units as u', 'u.id', '=', 'perencanaans.unit_id')
      ->leftJoin('statuses', function ($query) {
        $query->on('statuses.perencanaan_id', '=', 'perencanaans.id')
          ->whereRaw('statuses.created_at IN (select MAX(statuses.created_at) from statuses join perencanaans on perencanaans.id = statuses.perencanaan_id group by perencanaans.id)');
      }) // get last data from proses
      ->withCount('usulans')
      ->where('perencanaans.id', $id)
      ->groupBy(['perencanaans.id', 'perencanaans.p_tahun', 'perencanaans.p_periode', 'perencanaans.created_at', 'statuses.status', 'statuses.message', 'statuses.created_at', 'u.u_name', 'u.id'])
      ->first();
  }

  public function find_usulan_with_status(string $id): ?Perencanaan
  {
    return $this->model
      ->with(['statuses', 'unit'])
      ->withCount('usulans')
      ->where('perencanaans.id', $id)
      ->first();
  }
}
