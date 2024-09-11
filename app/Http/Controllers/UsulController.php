<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsulanRequest;
use App\Models\Usulan;
use App\Services\Datatables\UsulTableService;
use App\Services\PerencanaanService;
use App\Services\RuanganService;
use App\Services\UsulanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class UsulController extends Controller
{
  public function __construct(
    protected UsulanService $service
  ) {
    $this->middleware('permission:perencanaan create')->only(['create', 'store', 'destroy', 'multdelete', 'edit', 'update']);
    $this->middleware('permission:perencanaan read')->only(['index', 'datatable', 'belanja']);
  }

  //----------  INDEX  ----------//
  public function index(): View|RedirectResponse
  {
    if (!Session::get('usulan'))
      return to_route('usulan.index');

    return view('usul.index', [
      'data' => app(PerencanaanService::class)->find_usulan_with_status(Session::get('usulan') ?? 'x'),
    ]);
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return app(UsulTableService::class)->table(Session::get('usulan'));
  }

  //----------  CREATE  ----------//
  public function create(): View
  {
    Gate::authorize('update', Usulan::class);

    $ruangans = app(RuanganService::class)->select_by_unit(auth()->user()->unit_id);

    return view('usul.create', [
      'ruangans' => $ruangans,
    ]);
  }

  //----------  STORE  ----------//
  public function store(UsulanRequest $request): RedirectResponse
  {
    Gate::authorize('update', Usulan::class);
    $usulan = $this->service->store($request);

    if ($usulan)
      return to_route('usul.index')->with('success', 'Usulan baru berhasil ditambahkan.');

    return to_route('usul.index')->with('error', 'Usulan baru gagal ditambahkan.');
  }

  //----------  EDIT  ----------//
  public function edit($usul): View
  {
    Gate::authorize('update', Usulan::class);

    $ruangans = app(RuanganService::class)->select_by_unit(auth()->user()->unit_id);

    return view('usul.edit', [
      'ruangans' => $ruangans,
      'data' => $this->service->find($usul),
    ]);
  }

  //----------  UPDATE  ----------//
  public function update($usul, UsulanRequest $request): RedirectResponse
  {
    Gate::authorize('update', Usulan::class);

    $query = $this->service->update($usul, $request);
    if ($query)
      return redirect()->route('usul.index')->with('success', 'Data berhasil diubah.');

    return redirect()->route('usul.index')->with('error', 'Data gagal diubah.');
  }

  //----------  DESTROY  ----------//
  public function destroy($usul): JsonResponse
  {
    Gate::authorize('update', Usulan::class);

    try {
      $this->service->delete($usul);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }

  //----------  MULTDELETE  ----------//
  public function multdelete(Request $request): JsonResponse
  {
    Gate::authorize('update', Usulan::class);

    try {
      $this->service->multipleDelete($request->post('ids'));
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }
}
