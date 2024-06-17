<?php

namespace App\Services\Datatables;

use App\Repositories\JenbelRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class JenbelTableService extends DatatableService
{
  public function __construct(
    protected JenbelRepository $repository
  ) {
  }

  public function table(int|string $parent): JsonResponse
  {
    $id = !$parent ? null : $parent;

    return DataTables::of($this->repository->table($id))
      ->addColumn('aksi', function ($data) use ($id) {
        $strMenu = $data->jb_level > 2 ? '' :
          self::btn("jenbel/" . $data->id . "/", "Sub Jenis Belanja");
        $strMenu .= auth()->user()->can('jenis_belanja update') ?
          self::editBtnA(route('jenbel.edit', ['jenbel' => $data->id, 'parent' => $id ?? 0])) : '';
        $strMenu .= auth()->user()->can('jenis_belanja delete') ?
          self::deleteBtn($data->id, $data->jb_name) : '';

        return $strMenu;
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb'])
      ->make();
  }
}
