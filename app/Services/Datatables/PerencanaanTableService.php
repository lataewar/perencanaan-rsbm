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
        return
          self::editBtnA(route('perencanaan.edit', ['perencanaan' => $data->id]))
          . self::deleteBtn($data->id, '');
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb'])
      ->make();
  }
}
