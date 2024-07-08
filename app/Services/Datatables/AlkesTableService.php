<?php

namespace App\Services\Datatables;

use App\Repositories\AlkesRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class AlkesTableService extends DatatableService
{
  public function __construct(
    protected AlkesRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      // ->addColumn('cb', function ($data) {
      //   return self::checkBox($data->id);
      // })
      // ->rawColumns(['cb'])
      ->make();
  }
}
