<?php

namespace App\Services\Datatables;

use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class UserTableService extends DatatableService
{
  public function __construct(
    protected UserRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        $strMenu = auth()->user()->can('user update') ?
          self::editBtnA(route('user.edit', ['user' => $data->id])) : '';
        $strMenu .= auth()->user()->can('user delete') ?
          self::deleteBtn($data->id, $data->name) : '';

        return $strMenu;
      })
      ->addColumn('role', function ($data) {
        return $data->role_id->getLabelHTML();
      })
      ->addColumn('dibuat', function ($data) {
        return $data->created_at->isoFormat('dddd, D MMMM Y');
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb', 'role', 'dibuat'])

      ->make();
  }
}
