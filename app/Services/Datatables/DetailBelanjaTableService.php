<?php

namespace App\Services\Datatables;

use App\Repositories\BarangRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class DetailBelanjaTableService extends DatatableService
{
  public function __construct(
    protected BarangRepository $repository
  ) {
  }

  public function table(string $id): JsonResponse
  {
    return DataTables::of($this->repository->table($id))
      ->addColumn('aksi', function ($data) use ($id) {
        return
          self::editBtnA(route('detailbelanja.edit', ['barang' => $data->id, 'id' => $id]))
          . self::deleteBtn($data->id, $data->br_name);
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb'])
      ->make();
  }
}
