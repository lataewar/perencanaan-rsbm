<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Services\Datatables\UnitTableService;
use App\Services\UnitService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UnitController extends Controller
{
  public function __construct(
    protected UnitService $service
  ) {
    $this->middleware('permission:unit_kerja create')->only(['create', 'store']);
    $this->middleware('permission:unit_kerja read')->only(['index', 'datatable']);
    $this->middleware('permission:unit_kerja update')->only(['edit', 'update']);
    $this->middleware('permission:unit_kerja delete')->only(['destroy']);
    $this->middleware('permission:unit_kerja multidelete')->only(['multdelete']);
  }

  //----------  INDEX  ----------//
  public function index(): View
  {
    return view('unit.index');
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return app(UnitTableService::class)->table();
  }

  //----------  CREATE  ----------//
  public function create(): View
  {
    return view('unit.create');
  }

  //----------  STORE  ----------//
  public function store(UnitRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('unit.index')->with('success', '<b>' . $query->u_name . '</b> berhasil ditambahkan.');

    return redirect()->route('unit.index');
  }

  //----------  EDIT  ----------//
  public function edit($unit): View
  {
    return view('unit.edit', ['data' => $this->service->find($unit)]);
  }

  //----------  UPDATE  ----------//
  public function update($unit, UnitRequest $request): RedirectResponse
  {
    $query = $this->service->update($unit, $request);
    if ($query)
      return redirect()->route('unit.index')->with('success', '<b>' . $query->u_name . '</b> berhasil diubah.');

    return redirect()->route('unit.index');
  }

  //----------  DESTROY  ----------//
  public function destroy($unit): JsonResponse
  {
    try {
      $this->service->delete($unit);
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
