<?php

namespace App\Services\Datatables;

use App\Repositories\SubMenuRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class SubMenuTableService extends DatatableService
{
  public function __construct(
    protected SubMenuRepository $repository
  ) {
  }

  public function table(int $id): JsonResponse
  {
    return DataTables::of($this->repository->table($id))
      ->addColumn('aksi', function ($data) {
        $strMenu = auth()->user()->can('menu update') ?
          self::editBtnA(route('submenu.edit', ['submenu' => $data->id, 'menu' => $data->menu_id])) : '';
        $strMenu .= auth()->user()->can('menu delete') ?
          self::deleteBtn($data->id, $data->name) : '';

        return $strMenu;
      })
      ->rawColumns(['aksi'])
      ->make();
  }
}
