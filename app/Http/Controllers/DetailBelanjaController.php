<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailBelanjaRequest;
use App\Repositories\BelanjaRepository;
use App\Services\BarangService;
use App\Services\DetailBelanjaService;
use App\Services\Datatables\DetailBelanjaTableService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DetailBelanjaController extends Controller
{
  public function __construct(
    protected DetailBelanjaService $service
  ) {
    // $this->middleware('permission:perencanaan create')->only(['create', 'store']);
    // $this->middleware('permission:perencanaan read')->only(['index', 'datatable']);
    // $this->middleware('permission:perencanaan delete')->only(['destroy']);
    // $this->middleware('permission:perencanaan multidelete')->only(['multdelete']);

    if (!Session::get('belanja_id'))
      redirect()->route('belanja.index');
  }

  //----------  INDEX  ----------//
  public function index(): View|RedirectResponse
  {
    return view('detailbelanja.index', [
      'data' => $this->service->detail_belanja(Session::get('belanja_id')),
    ]);
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return app(DetailBelanjaTableService::class)->table(Session::get('belanja_id'));
  }

  //----------  CREATE  ----------//
  public function create(): View
  {
    return view('detailbelanja.create', [
      'barangs' => app(BarangService::class)->getByBelanja(Session::get('belanja_id')),
    ]);
  }

  //----------  STORE  ----------//
  public function store(DetailBelanjaRequest $request): RedirectResponse
  {
    $query = $this->service->store(Session::get('belanja_id'), $request);
    if ($query)
      return redirect()->route('detailbelanja.index')->with('success', 'Data berhasil ditambahkan.');

    return redirect()->route('detailbelanja.index')->with('error', 'Data gagal ditambahkan.');
  }

  //----------  EDIT  ----------//
  public function edit($barang, $belanja): View
  {
    return view('detailbelanja.edit', [
      'data' => $this->service->find_pivot($barang, $belanja),
    ]);
  }

  //----------  UPDATE  ----------//
  public function update($barang, $belanja, DetailBelanjaRequest $request): RedirectResponse
  {
    $query = $this->service->update($barang, $belanja, $request);
    if ($query)
      return redirect()->route('detailbelanja.index')->with('success', 'Data berhasil diubah.');

    return redirect()->route('detailbelanja.index')->with('error', 'Data gagal diubah.');
  }

  //----------  DESTROY  ----------//
  public function destroy($barang): JsonResponse
  {
    $ids = explode("-x-", $barang);
    try {
      $this->service->delete_pivot($ids[0], $ids[1]);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }

  //----------  MULTDELETE  ----------//
  public function multdelete(Request $request): JsonResponse
  {
    try {
      $this->service->delete_pivot($request->post('ids'), Session::get('belanja_id'));
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }
}