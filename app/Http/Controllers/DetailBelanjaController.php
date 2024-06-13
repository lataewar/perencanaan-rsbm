<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailBelanjaRequest;
use App\Repositories\BelanjaRepository;
use App\Services\BarangService;
use App\Services\DetailBelanjaService;
use App\Services\Datatables\DetailBelanjaTableService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
  }

  //----------  INDEX  ----------//
  public function index()//: View|RedirectResponse
  {
    // return app(BelanjaRepository::class)->table_barangs(Session::get('belanja_id'))->get();
    $belanja = Session::get('belanja_id') ?? null;
    if (!$belanja)
      return redirect()->route('belanja.index');

    return view('detailbelanja.index', [
      // 'belanja' => $belanja,
    ]);
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return app(DetailBelanjaTableService::class)->table(Session::get('belanja_id') ?? "x");
  }

  //----------  CREATE  ----------//
  public function create()//: View
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

    return redirect()->route('detailbelanja.index');
  }

  //----------  EDIT  ----------//
  public function edit($barang, $belanja)//: View
  {
    // return $this->service->find_pivot($barang, $belanja);
    return view('detailbelanja.edit', [
      'barangs' => app(BarangService::class)->getByBelanja(Session::get('belanja_id')),
      'data' => $this->service->find_pivot($barang, $belanja),
    ]);
  }

  //----------  UPDATE  ----------//
  public function update($barang, $belanja, DetailBelanjaRequest $request): RedirectResponse
  {
    $query = $this->service->update($barang, $request);
    if ($query)
      return redirect()->route('detailbelanja.index', ['id' => $id])->with('success', '<b>' . $query->br_name . '</b> berhasil diubah.');

    return redirect()->route('detailbelanja.index', ['id' => $id]);
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
