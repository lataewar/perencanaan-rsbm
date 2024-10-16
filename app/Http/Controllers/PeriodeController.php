<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeriodeRequest;
use App\Services\Datatables\PeriodeTableService;
use App\Services\PeriodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PeriodeController extends Controller
{
  public function __construct(
    protected PeriodeService $service
  ) {
    $this->middleware('permission:periode create')->only(['create', 'store']);
    $this->middleware('permission:periode read')->only(['index', 'datatable']);
    $this->middleware('permission:periode update')->only(['edit', 'update']);
    $this->middleware('permission:periode delete')->only(['destroy']);
  }

  //----------  INDEX  ----------//
  public function index(): View
  {
    return view('periode.index');
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return app(PeriodeTableService::class)->table();
  }

  //----------  CREATE  ----------//
  public function create(): View
  {
    return view('periode.create');
  }

  //----------  STORE  ----------//
  public function store(PeriodeRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('periode.index')->with('success', '<b>' . $query->u_name . '</b> berhasil ditambahkan.');

    return redirect()->route('periode.index');
  }

  //----------  EDIT  ----------//
  public function edit($periode): View
  {
    return view('periode.edit', ['data' => $this->service->find($periode)]);
  }

  //----------  UPDATE  ----------//
  public function update($periode, PeriodeRequest $request): RedirectResponse
  {
    $query = $this->service->update($periode, $request);
    if ($query)
      return redirect()->route('periode.index')->with('success', '<b>' . $query->u_name . '</b> berhasil diubah.');

    return redirect()->route('periode.index');
  }

  //----------  DESTROY  ----------//
  public function destroy($periode): JsonResponse
  {
    try {
      $this->service->delete($periode);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }
}
