<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanRequest;
use App\Services\PerencanaanService;
use App\Services\UnitService;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PerencanaanController extends Controller
{
  public function __construct(
    protected PerencanaanService $service
  ) {
    $this->middleware('permission:perencanaan create')->only(['create', 'store']);
    $this->middleware('permission:perencanaan read')->only(['index', 'setfilter', 'belanja']);
    $this->middleware('permission:perencanaan delete')->only(['destroy']);
  }

  //----------  INDEX  ----------//
  public function index(): View
  {
    return view('perencanaan.index', [
      'units' => app(UnitService::class)->getAll(),
      'data' => $this->service->table(),
    ]);
  }

  //----------  SET FILTER  ----------//
  public function setfilter(Request $request): RedirectResponse
  {
    $this->service->setfilter($request);
    return redirect()->route('perencanaan.index');
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
  public function destroy(Request $request): RedirectResponse
  {
    if (!$this->service->delete($request->destroy))
      Session::flash('error', 'Terjadi kesalahan pada proses hapus perencanaan.');

    Session::flash('success', 'Perencanaan terhapus.');
    return redirect()->route('perencanaan.index');
  }
}
