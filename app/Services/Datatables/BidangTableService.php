<?php

namespace App\Services\Datatables;

use App\Repositories\BidangRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class BidangTableService extends DatatableService
{
  public function __construct(
    protected BidangRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        $strMenu = auth()->user()->can('bidang read') ?
          self::naviItem(route('bidang.unit', ['bidang' => $data->id]), 'Unit', "la la-lock-open", "") .
          self::navSeparator() : '';
        $strMenu .= auth()->user()->can('bidang update') ?
          self::naviItem(route('bidang.edit', ['bidang' => $data->id]), 'Ubah Data', "la la-pencil", "") : '';
        $strMenu .= auth()->user()->can('bidang delete') ?
          self::naviItem('javascript:;', 'Hapus Data', "la la-trash", "onclick=\"destroy('" . $data->id . "', '" . $data->b_name . "')\"") : '';

        return self::aksiDropdown($strMenu);
      })
      ->rawColumns(['aksi'])
      ->make();
  }
}
