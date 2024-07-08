<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\PerencanaanRequest;
use App\Services\PerencanaanService;
use App\Services\UnitService;
use App\Services\UsulanService;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class UsulanController extends Controller
{
  public function __construct(
    protected UsulanService $service
  ) {
    $this->middleware('permission:perencanaan create')->only(['create', 'store']);
    $this->middleware('permission:perencanaan send')->only(['send']);
    $this->middleware('permission:perencanaan read')->only(['index', 'setfilter', 'usul']);
    $this->middleware('permission:perencanaan delete')->only(['destroy']);
  }

  //----------  INDEX  ----------//
  public function index(): View
  {
    $units = !auth()->user()->role_id->isUnit() ? app(UnitService::class)->getAll() : [];

    return view('usulan.index', [
      'units' => $units,
      'data' => app(PerencanaanService::class)->usul_table(),
    ]);
  }

  //----------  SET FILTER  ----------//
  public function setfilter(Request $request): RedirectResponse
  {
    $this->service->setfilter($request);
    return to_route('usulan.index');
  }

  //----------  USUL  ----------//
  public function usul(string $usul): RedirectResponse
  {
    Session::put('usulan', $usul);
    return to_route('usul.index');
  }

  //----------  CREATE  ----------//
  public function create(): View
  {
    return view('usulan.create', ['tahuns' => $this->service->getTahun()]);
  }

  //----------  STORE  ----------//
  public function store(PerencanaanRequest $request): RedirectResponse
  {
    try {
      app(PerencanaanService::class)->store($request);
      return to_route('usulan.index')->with('success', 'Usulan baru berhasil ditambahkan.');

    } catch (QueryException $e) {
      $errorCode = $e->errorInfo[1];
      if ($errorCode == 1062) {
        // we have a duplicate entry problem
        return to_route('usulan.index')->with('error', 'Tahun usulan sudah ada sebelumnya.');
      }
      return to_route('usulan.index')->with('error', 'Usulan baru gagal ditambahkan.');
    }
  }

  //----------  DESTROY  ----------//
  public function destroy(Request $request): RedirectResponse
  {
    if (!app(PerencanaanService::class)->delete($request->destroy))
      Session::flash('error', 'Terjadi kesalahan pada proses hapus usulan.');

    Session::flash('success', 'Usulan terhapus.');
    return to_route('usulan.index');
  }

  //----------  SEND  ----------//
  public function send(Request $request): RedirectResponse
  {
    $find = app(PerencanaanService::class)->find_usulan($request->id);
    $status = StatusEnum::from($find->status);

    if ($find->u_id != auth()->user()->unit_id) // Cek Unit
      return to_route('usulan.index')->with('error', 'Unit salah.');
    if (!$status->isDraft() && !$status->isDitolak()) // Cek Status is_draft or is_ditolak
      return to_route('usulan.index')->with('error', 'Terjadi kesalahan pada proses kirim.');
    if ($find->usulans_count == 0) // cek jumlah barang usulan
      return to_route('usulan.index')->with('error', 'Belum ada barang usulan.');

    if (app(PerencanaanService::class)->update_status($request->id, StatusEnum::DIKIRIM->value, 'Perencanaan dikirim.'))
      return to_route('usulan.index')->with('success', 'Perencanaan berhasil dikirim.');

    return to_route('usulan.index');
  }
}
