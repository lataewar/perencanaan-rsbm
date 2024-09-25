<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Services\PerencanaanService;
use App\Services\UnitService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PerencanaanController extends Controller
{
  public function __construct(
    protected PerencanaanService $service
  ) {
    $this->middleware('permission:perencanaan accept')->only(['accept']);
    $this->middleware('permission:perencanaan validate')->only(['validasi']);
    $this->middleware('permission:perencanaan reject')->only(['reject']);
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
    return to_route('perencanaan.index');
  }

  //----------  BELANJA  ----------//
  public function belanja(string $id): RedirectResponse
  {
    Session::put('perencanaan_id', $id);
    return to_route('belanja.index');
  }

  //----------  ACCEPT  ----------//
  public function accept(Request $request): RedirectResponse
  {
    Gate::authorize('accept', $this->service->find_status($request->id));

    if ($this->service->update_status($request->id, StatusEnum::DISETUJUI->value, 'Perencanaan disetujui.'))
      return to_route('perencanaan.index')->with('success', 'Perencanaan berhasil dikirim.');

    return to_route('perencanaan.index');
  }

  //----------  VALIDATE  ----------//
  public function validasi(Request $request): RedirectResponse
  {
    Gate::authorize('validasi', $this->service->find_status($request->id));

    if ($this->service->update_status($request->id, StatusEnum::DIVALIDASI->value, 'Perencanaan divalidasi.'))
      return to_route('perencanaan.index')->with('success', 'Perencanaan berhasil dikirim.');

    return to_route('perencanaan.index');
  }

  //----------  REJECT  ----------//
  public function reject(Request $request): RedirectResponse
  {
    Gate::authorize('reject', $this->service->find_status($request->id));

    if ($this->service->update_status($request->id, StatusEnum::DITOLAK->value, 'Perencanaan ditolak.'))
      return to_route('perencanaan.index')->with('success', 'Perencanaan berhasil dikirim.');

    return to_route('perencanaan.index');
  }
}
