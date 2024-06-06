<?php

namespace App\Services\Datatables;

use App\Repositories\UnitRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class UnitTableService extends DatatableService
{
  public function __construct(
    protected UnitRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        return
          self::editBtnA(route('unit.edit', ['unit' => $data->id]))
          . self::deleteBtn($data->id, $data->u_name);
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb'])
      ->make();
  }
}
