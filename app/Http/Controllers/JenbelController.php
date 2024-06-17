<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenbelRequest;
use App\Services\Datatables\JenbelTableService;
use App\Services\JenbelService;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JenbelController extends Controller
{
  public function __construct(
    protected JenbelService $service
  ) {
    $this->middleware('permission:jenis_belanja create')->only(['create', 'store']);
    $this->middleware('permission:jenis_belanja read')->only(['index', 'datatable']);
    $this->middleware('permission:jenis_belanja update')->only(['edit', 'update']);
    $this->middleware('permission:jenis_belanja delete')->only(['destroy']);
    $this->middleware('permission:jenis_belanja multidelete')->only(['multdelete']);
  }

  //----------  INDEX  ----------//
  public function index($parent = 0): View
  {
    $parent = $this->service->find($parent);
    abort_if($parent && $parent->jb_level > 2, 404);

    return view('jenbel.index', [
      'parent' => $parent ?? null,
    ]);
  }

  //----------  DATATABLE  ----------//
  public function datatable($parent = 0): JsonResponse
  {
    return app(JenbelTableService::class)->table($parent);
  }

  //----------  CREATE  ----------//
  public function create($parent = 0): View
  {
    return view('jenbel.create', [
      'parent' => $this->service->find($parent),
    ]);
  }

  //----------  STORE  ----------//
  public function store(JenbelRequest $request, $parent = 0): RedirectResponse
  {
    $query = $this->service->store($request, $parent);
    if ($query)
      return redirect()->route('jenbel.index', ['parent' => $parent])->with('success', '<b>' . $query->jb_name . '</b> berhasil ditambahkan.');

    return redirect()->route('jenbel.index', ['parent' => $parent]);
  }

  //----------  EDIT  ----------//
  public function edit($parent, $jenbel): View
  {
    return view('jenbel.edit', [
      'parent' => $this->service->find($parent),
      'data' => $this->service->find($jenbel),
    ]);
  }

  //----------  UPDATE  ----------//
  public function update($parent, $jenbel, JenbelRequest $request): RedirectResponse
  {
    $query = $this->service->update($jenbel, $request);
    if ($query)
      return redirect()->route('jenbel.index', ['parent' => $parent])->with('success', '<b>' . $query->jb_name . '</b> berhasil diubah.');

    return redirect()->route('jenbel.index', ['parent' => $parent]);
  }

  //----------  DESTROY  ----------//
  public function destroy($parent, $jenbel): JsonResponse
  {
    try {
      $this->service->delete($jenbel);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (QueryException $e) {
      $errorCode = $e->errorInfo[1];
      if ($errorCode == 1451) {
        // Error Constraint Fails
        return response()->json(['gagal' => 'Data gagal dihapus. <br> Jenis Belanja memiliki Sub Jenis Belanja.']);
      }
      return response()->json(['gagal' => 'Data gagal dihapus.']);
    }
  }

  //----------  MULTDELETE  ----------//
  public function multdelete($parent, Request $request): JsonResponse
  {
    $query = $this->service->multipleDelete($request->post('ids'));
    if ($query)
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);

    return response()->json(['gagal' => 'Data gagal dihapus.']);
  }
}
