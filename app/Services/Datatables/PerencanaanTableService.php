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
        $strMenu .= self::naviItem('javascript:;', 'Hapus Data', "la la-trash", "onclick=\"destroy('" . $data->id . "', 'Perencanaan " . $data->u_name . ' Tahun ' . $data->p_tahun . "')\"");

        return self::aksiDropdown($strMenu);
      })
      ->addColumn('status', function ($data) {
        return $data->p_status->getLabelHTML();
      })
      ->addColumn('unit', function ($data) {
        return "<span class='font-weight-bold'>$data->u_name</span><br><span class='font-size-sm text-success'>$data->p_tahun</span>";
      })
      ->addColumn('dibuat', function ($data) {
        return formatTime($data->created_at);
      })
      ->addColumn('total', function ($data) {
        return formatNomor($data->total);
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb', 'status', 'dibuat', 'unit', 'total'])
      ->make();
  }
}
