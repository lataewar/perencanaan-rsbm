<?php

namespace App\Services\Datatables;

use App\Repositories\BarangRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class BarangTableService extends DatatableService
{
  public function __construct(
    protected BarangRepository $repository
  ) {
  }

  public function table(int|string $id = null): JsonResponse
  {
    return DataTables::of($this->repository->table($id))
      ->addColumn('aksi', function ($data) use ($id) {
        $strMenu = auth()->user()->can('barang update') ?
          self::editBtnA(route('barang.edit', ['barang' => $data->id, 'id' => $id])) : '';
        $strMenu .= auth()->user()->can('barang delete') ?
          self::deleteBtn($data->id, $data->br_name) : '';

        return $strMenu;
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb'])
      ->make();
  }
}
