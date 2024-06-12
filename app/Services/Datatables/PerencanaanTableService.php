<?php

namespace App\Services\Datatables;

use App\Repositories\PerencanaanRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class PerencanaanTableService extends DatatableService
{
  public function __construct(
    protected PerencanaanRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        $strMenu = self::naviItem(route('perencanaan.belanja', ['perencanaan' => $data->id]), 'Perbelanjaan', "la la-money-check-alt", "");
        $strMenu .= self::naviItem('javascript:;', 'Hapus Data', "la la-trash", "onclick=\"destroy('" . $data->id . "', 'Perencanaan " . $data->unit->u_name . ' Tahun ' . $data->p_tahun . "')\"");

        return self::aksiDropdown($strMenu);
      })
      ->addColumn('status', function ($data) {
        return $data->p_status->getLabelHTML();
      })
      ->addColumn('dibuat', function ($data) {
        return formatTime($data->created_at);
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb', 'status', 'dibuat'])
      ->make();
  }
}
