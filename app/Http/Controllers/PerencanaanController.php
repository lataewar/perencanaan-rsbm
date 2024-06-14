<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanRequest;
use App\Services\Datatables\PerencanaanTableService;
use App\Services\PerencanaanService;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PerencanaanController extends Controller
{
  public function __construct(
    protected PerencanaanService $service
  ) {
    // $this->middleware('permission:perencanaan create')->only(['create', 'store']);
    // $this->middleware('permission:perencanaan read')->only(['index', 'datatable']);
    // $this->middleware('permission:perencanaan delete')->only(['destroy']);
    // $this->middleware('permission:perencanaan multidelete')->only(['multdelete']);
  }

  //----------  INDEX  ----------//
  public function index(): View
  {
    return view('perencanaan.index');
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return app(PerencanaanTableService::class)->table();
  }

  //----------  CREATE  ----------//
  public function create(): View
  {
    return view('perencanaan.create', ['tahuns' => $this->service->getTahun()]);
  }

  //----------  STORE  ----------//
  public function store(PerencanaanRequest $request): RedirectResponse
  {
    try {
      $this->service->store($request);
      return redirect()->route('perencanaan.index')->with('success', 'Perencenaan baru berhasil ditambahkan.');

    } catch (QueryException $e) {
      $errorCode = $e->errorInfo[1];
      if ($errorCode == 1062) {
        // we have a duplicate entry problem
        return redirect()->route('perencanaan.index')->with('error', 'Tahun perencanaan sudah ada sebelumnya.');
      }
      return redirect()->route('perencanaan.index')->with('error', 'Perencenaan baru gagal ditambahkan.');
    }
  }

  //----------  BELANJA  ----------//
  public function belanja(string $id): RedirectResponse
  {
    Session::put('perencanaan_id', $id);
    return redirect()->route('belanja.index');
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
