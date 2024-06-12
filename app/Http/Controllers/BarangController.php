<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Services\BarangService;
use App\Services\Datatables\BarangTableService;
use App\Services\JenbelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BarangController extends Controller
{
  public function __construct(
    protected BarangService $service
  ) {
    // $this->middleware('permission:barang create')->only(['create', 'store']);
    // $this->middleware('permission:barang read')->only(['index', 'datatable']);
    // $this->middleware('permission:barang update')->only(['edit', 'update']);
    // $this->middleware('permission:barang delete')->only(['destroy']);
    // $this->middleware('permission:barang multidelete')->only(['multdelete']);
  }

  //----------  INDEX  ----------//
  public function index($id = 0): View
  {
    return view('barang.index', [
      'id' => $id,
      'jenbel' => app(JenbelService::class)->getALlByLevel(3),
    ]);
  }

  //----------  DATATABLE  ----------//
  public function datatable($id = 0): JsonResponse
  {
    return app(BarangTableService::class)->table($id);
  }

  //----------  CREATE  ----------//
  public function create($id): View
  {
    return view('barang.create', compact('id'));
  }

  //----------  STORE  ----------//
  public function store($id, BarangRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('barang.index', ['id' => $id])->with('success', '<b>' . $query->br_name . '</b> berhasil ditambahkan.');

    return redirect()->route('barang.index', ['id' => $id]);
  }

  //----------  EDIT  ----------//
  public function edit($id, $barang): View
  {
    return view('barang.edit', [
      'id' => $id,
      'data' => $this->service->find($barang),
    ]);
  }

  //----------  UPDATE  ----------//
  public function update($id, $barang, BarangRequest $request): RedirectResponse
  {
    $query = $this->service->update($barang, $request);
    if ($query)
      return redirect()->route('barang.index', ['id' => $id])->with('success', '<b>' . $query->br_name . '</b> berhasil diubah.');

    return redirect()->route('barang.index', ['id' => $id]);
  }

  //----------  DESTROY  ----------//
  public function destroy($id, $barang): JsonResponse
  {
    try {
      $this->service->delete($barang);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }

  //----------  MULTDELETE  ----------//
  public function multdelete($id, Request $request): JsonResponse
  {
    try {
      $this->service->multipleDelete($request->post('ids'));
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }
}
