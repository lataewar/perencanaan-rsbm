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

  public function table(int $parent): JsonResponse
  {
    $id = !$parent ? null : $parent;

    return DataTables::of($this->repository->table($id))
      ->addColumn('aksi', function ($data) use ($id) {
        return
          ($data->jb_level > 2 ? '' :
            self::btn("jenbel/" . $data->id . "/", "Sub Jenis Belanja"))
          . self::editBtnA(route('jenbel.edit', ['jenbel' => $data->id, 'parent' => $id ?? 0]))
          . self::deleteBtn($data->id, $data->jb_name);
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb'])
      ->make();
  }
}
