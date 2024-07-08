<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
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
    $this->middleware('permission:perencanaan follow_up')->only(['accept', 'reject']);
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
      return to_route('perencanaan.index')->with('success', 'Perencenaan baru berhasil ditambahkan.');

    } catch (QueryException $e) {
      $errorCode = $e->errorInfo[1];
      if ($errorCode == 1062) {
        // we have a duplicate entry problem
        return to_route('perencanaan.index')->with('error', 'Tahun perencanaan sudah ada sebelumnya.');
      }
      return to_route('perencanaan.index')->with('error', 'Perencenaan baru gagal ditambahkan.');
    }
  }

  //----------  BELANJA  ----------//
  public function belanja(string $id): RedirectResponse
  {
    Session::put('perencanaan_id', $id);
    return to_route('belanja.index');
  }

  //----------  DESTROY  ----------//
  public function destroy(Request $request): RedirectResponse
  {
    if (!$this->service->delete($request->destroy))
      Session::flash('error', 'Terjadi kesalahan pada proses hapus perencanaan.');

    Session::flash('success', 'Perencanaan terhapus.');
    return to_route('perencanaan.index');
  }

  //----------  ACCEPT  ----------//
  public function accept(Request $request): RedirectResponse
  {
    $find = $this->service->find_total($request->id);
    $status = StatusEnum::from($find->status);

    if (!auth()->user()->role_id->isPerencana()) // Cek Role is_perencana
      return to_route('perencanaan.index')->with('error', 'Role salah.');
    if (!$status->isDikirim()) // Cek Status is_dikirim
      return to_route('perencanaan.index')->with('error', 'Terjadi kesalahan pada proses kirim.');

    if ($this->service->update_status($request->id, StatusEnum::DISETUJUI->value, 'Perencanaan disetujui.'))
      return to_route('perencanaan.index')->with('success', 'Perencanaan berhasil dikirim.');

    return to_route('perencanaan.index');
  }

  //----------  REJECT  ----------//
  public function reject(Request $request): RedirectResponse
  {
    $find = $this->service->find_total($request->id);
    $status = StatusEnum::from($find->status);

    if (!auth()->user()->role_id->isPerencana()) // Cek Role is_perencana
      return to_route('perencanaan.index')->with('error', 'Role salah.');
    if (!$status->isDikirim()) // Cek Status is_dikirim
      return to_route('perencanaan.index')->with('error', 'Terjadi kesalahan pada proses kirim.');

    if ($this->service->update_status($request->id, StatusEnum::DITOLAK->value, 'Perencanaan ditolak.'))
      return to_route('perencanaan.index')->with('success', 'Perencanaan berhasil dikirim.');

    return to_route('perencanaan.index');
  }
}
