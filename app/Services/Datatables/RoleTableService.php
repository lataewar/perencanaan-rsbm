<?php

namespace App\Services\Datatables;

use App\Repositories\RoleRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class RoleTableService extends DatatableService
{
  public function __construct(
    protected RoleRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        $strMenu = auth()->user()->can('role read') ?
          self::naviItem(route('role.akses', ['role' => $data->id]), 'Akses ke Menu', "la la-icons", "") .
          self::naviItem(route('role.permission', ['role' => $data->id]), 'Perizinan', "la la-lock-open", "") .
          self::navSeparator() : '';
        $strMenu .= auth()->user()->can('role update') ?
          self::naviItem(route('role.edit', ['role' => $data->id]), 'Ubah Data', "la la-pencil", "") : '';
        $strMenu .= auth()->user()->can('role delete') ?
          self::naviItem('javascript:;', 'Hapus Data', "la la-trash", "onclick=\"destroy('" . $data->id . "', '" . $data->name . "')\"") : '';

        return self::aksiDropdown($strMenu);
      })
      ->rawColumns(['aksi'])
      ->make();
  }
}
