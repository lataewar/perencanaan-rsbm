<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Services\BarangService;
use App\Services\Datatables\BarangTableService;
use App\Services\JenbelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BarangController extends Controller
{
  public function __construct(
    protected BarangService $service
  ) {
    $this->middleware('permission:barang create')->only(['create', 'store']);
    $this->middleware('permission:barang read')->only(['index', 'datatable']);
    $this->middleware('permission:barang update')->only(['edit', 'update']);
    $this->middleware('permission:barang delete')->only(['destroy']);
    $this->middleware('permission:barang multidelete')->only(['multdelete']);
  }

  //----------  SET BELANJA  ----------//
  public function setbelanja(Request $request): View|RedirectResponse
  {
    if ($request->method() == "POST") {
      $request->validate([
        'jenisbelanjaid1' => ['required'],
        'jenisbelanjaid2' => ['required'],
        'jenisbelanjaid3' => ['required'],
      ]);
      Session::put('jenis_belanja_id', $request->jenisbelanjaid3);
      return to_route('barang.index');
    }

    return view('barang.getbelanja', [
      'jenbels' => app(JenbelService::class)->getALlByLevel(1),
    ]);
  }

  //----------  INDEX  ----------//
  public function index(): View|RedirectResponse
  {
    if (!Session::get('jenis_belanja_id'))
      return to_route('barang.getbelanja');

    return view('barang.index', [
      'jenbel' => app(JenbelService::class)->find(Session::get('jenis_belanja_id')),
    ]);
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return app(BarangTableService::class)->table(Session::get('jenis_belanja_id'));
  }

  //----------  CREATE  ----------//
  public function create(): View|RedirectResponse
  {
    if (!Session::get('jenis_belanja_id'))
      return to_route('barang.getbelanja');

    return view('barang.create');
  }

  //----------  STORE  ----------//
  public function store(BarangRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('barang.index')->with('success', '<b>' . $query->br_name . '</b> berhasil ditambahkan.');

    return redirect()->route('barang.index');
  }

  //----------  EDIT  ----------//
  public function edit($barang): View|RedirectResponse
  {
    if (!Session::get('jenis_belanja_id'))
      return to_route('barang.getbelanja');

    return view('barang.edit', [
      'data' => $this->service->find($barang),
    ]);
  }

  //----------  UPDATE  ----------//
  public function update($barang, BarangRequest $request): RedirectResponse
  {
    $query = $this->service->update($barang, $request);
    if ($query)
      return redirect()->route('barang.index')->with('success', '<b>' . $query->br_name . '</b> berhasil diubah.');

    return redirect()->route('barang.index');
  }

  //----------  DESTROY  ----------//
  public function destroy($barang): JsonResponse
  {
    try {
      $this->service->delete($barang);
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
