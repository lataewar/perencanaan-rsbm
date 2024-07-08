<?php

namespace App\Services\Datatables;

use App\Models\Usulan;
use App\Repositories\UsulanRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class UsulTableService extends DatatableService
{
  public function __construct(
    protected UsulanRepository $repository
  ) {
  }

  public function table(string $id): JsonResponse
  {
    return DataTables::of($this->repository->table($id))
      ->addColumn('aksi', function ($data) {
        $strMenu = auth()->user()->can('perencanaan update') && auth()->user()->can('update', Usulan::class) ?
          self::editBtnA(route('usul.edit', ['usul' => $data->id])) : '';
        $strMenu .= auth()->user()->can('perencanaan update') && auth()->user()->can('update', Usulan::class) ?
          self::deleteBtn($data->id, $data->ul_name) : '';

        return $strMenu;
      })
      ->addColumn('total', function ($data) {
        return formatNomor($data->ul_prise * $data->ul_qty);
      })
      ->addColumn('ul_prise', function ($data) {
        return formatNomor($data->ul_prise);
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb', 'total'])
      ->make();
  }
}
