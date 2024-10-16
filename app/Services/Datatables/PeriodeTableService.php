<?php

namespace App\Services\Datatables;

use App\Repositories\PeriodeRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class PeriodeTableService extends DatatableService
{
  public function __construct(
    protected PeriodeRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        $strMenu = auth()->user()->can('periode update') ?
          self::editBtnA(route('periode.edit', ['periode' => $data->id])) : '';
        $strMenu .= auth()->user()->can('periode delete') ?
          self::deleteBtn($data->id, $data->w_tahun . " " . $data->w_periode) : '';

        return $strMenu;
      })
      ->addColumn('periode', function ($data) {
        return "$data->w_tahun - periode $data->w_periode";
      })
      ->addColumn('waktu', function ($data) {
        return "$data->w_date_start - $data->w_date_end";
      })
      ->addColumn('status', function ($data) {
        $today = Carbon::today();
        $isActive = $today->between($data->w_date_start, $data->w_date_end);

        return $isActive ? "Aktif" : "Tidak Aktif";
      })
      ->rawColumns(['aksi', 'periode', 'waktu', 'status'])
      ->make();
  }
}
