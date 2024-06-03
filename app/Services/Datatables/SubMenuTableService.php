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
        return self::editBtnA(route('submenu.edit', ['submenu' => $data->id, 'menu' => $data->menu_id]))
          . self::deleteBtn($data->id, $data->name);
      })
      ->rawColumns(['aksi'])
      ->make();
  }
}
