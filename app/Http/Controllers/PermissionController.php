<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Services\Datatables\PermissionTableService;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
  public function __construct(
    protected PermissionService $service
  ) {
    $this->middleware('permission:permission create')->only(['create', 'store']);
    $this->middleware('permission:permission read')->only(['index', 'datatable']);
    $this->middleware('permission:permission update')->only(['edit', 'update']);
    $this->middleware('permission:permission delete')->only(['destroy']);
    $this->middleware('permission:permission multidelete')->only(['multdelete']);
  }

  //----------  INDEX  ----------//
  public function index(): View
  {
    return view('permission.index');
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return app(PermissionTableService::class)->table();
  }

  //----------  CREATE  ----------//
  public function create(): View
  {
    return view('permission.create');
  }

  //----------  STORE  ----------//
  public function store(PermissionRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('permission.index')->with('success', '<b>' . $query->name . '</b> berhasil ditambahkan.');

    return redirect()->route('permission.index');
  }

  //----------  EDIT  ----------//
  public function edit($permission): View
  {
    return view('permission.edit', ['data' => $this->service->find($permission)]);
  }

  //----------  UPDATE  ----------//
  public function update($permission, PermissionRequest $request): RedirectResponse
  {
    $query = $this->service->update($permission, $request);
    if ($query)
      return redirect()->route('permission.index')->with('success', '<b>' . $query->name . '</b> berhasil diubah.');

    return redirect()->route('permission.index');
  }

  //----------  DESTROY  ----------//
  public function destroy($permission): JsonResponse
  {
    try {
      $this->service->delete($permission);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }

  //----------  MULTDELETE  ----------//
  public function multdelete(Request $request): JsonResponse
  {
    try {
      $this->service->multipleDelete($request->post('ids'));
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }
}
