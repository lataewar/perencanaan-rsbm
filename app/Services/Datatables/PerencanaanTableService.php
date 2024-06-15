<?php

namespace App\Services\Datatables;

use App\Enums\StatusEnum;
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
        return StatusEnum::from($data->status)->getLabelHTML();
      })
      ->addColumn('unit', function ($data) {
        return "<span class='font-weight-bold'>$data->u_name</span><br><span class='font-size-sm text-success'>$data->p_tahun</span>";
      })
      ->addColumn('waktu', function ($data) {
        $time = formatTime($data->st_created_at);
        $tdfh = formatTDFH($data->st_created_at);
        return "<div class=''>$time</div><div class='font-size-sm font-weight-light text-muted'>$tdfh</div>";
      })
      ->addColumn('total', function ($data) {
        return formatNomor($data->total);
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb', 'status', 'waktu', 'unit', 'total'])
      ->make();
  }
}
