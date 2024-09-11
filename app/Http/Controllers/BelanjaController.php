<?php

namespace App\Http\Controllers;

use App\Http\Requests\BelanjaRequest;
use App\Http\Requests\BelanjaUpdateRequest;
use App\Http\Requests\CreateByUsulanRequest;
use App\Models\Belanja;
use App\Services\BelanjaService;
use App\Services\JenbelService;
use App\Services\PerencanaanService;
use App\Services\UsulanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BelanjaController extends Controller
{
  public function __construct(
    protected BelanjaService $service
  ) {
    $this->middleware('permission:perencanaan update')->only(['create', 'store', 'edit', 'update']);
    $this->middleware('permission:perencanaan read')->only(['index', 'detail']);
    $this->middleware('permission:perencanaan delete')->only(['destroy']);
  }

  //----------  INDEX  ----------//
  public function index(): View|RedirectResponse
  {
    if (!Session::get('perencanaan_id'))
      return to_route('perencanaan.index');

    $data = app(PerencanaanService::class)->find_total(Session::get('perencanaan_id') ?? 'x');

    return view('belanja.index', [
      'data' => $data,
      'statuses' => $data->statuses,
      'usulans' => app(UsulanService::class)->table(Session::get('perencanaan_id') ?? 'x'),
      'belanjas' => $this->service->table(Session::get('perencanaan_id') ?? 'x'),
    ]);
  }

  //----------  CREATE BY USULAN  ----------/
  public function createByUsulan(string $usulan): View|RedirectResponse
  {
    Gate::authorize('update', Belanja::class);
    $usulan = app(UsulanService::class)->find($usulan);

    if ($usulan->is_accommodated)
      return to_route('belanja.index');

    return view('belanja.create_by_usulan', [
      'usulan' => $usulan,
      'jenbels' => app(JenbelService::class)->getALlByLevel(1),
    ]);
  }

  //----------  STORE BY USULAN  ----------//
  public function storeByUsulan(CreateByUsulanRequest $request): RedirectResponse
  {
    Gate::authorize('update', Belanja::class);

    $query = $this->service->storeByUsulan($request);
    if ($query)
      return to_route('belanja.index')->with('success', 'Data berhasil ditambahkan.');

    return to_route('belanja.index');
  }

  //----------  DESTROY  ----------//
  public function destroy(Request $request): RedirectResponse
  {
    Gate::authorize('update', Belanja::class);

    $query = $this->service->delete_pivot($request->pivot_id, $request->belanja_id, $request->usulan_id);
    if ($query)
      return to_route('belanja.index')->with('success', 'Data berhasil dihapus.');

    return to_route('belanja.index')->with('error', 'Data gagal dihapus.');
  }

  //----------  CREATE  ----------/
  public function create(): View
  {
    Gate::authorize('update', Belanja::class);

    return view('belanja.create', [
      'jenbels' => app(JenbelService::class)->getALlByLevel(1),
    ]);
  }

  //----------  STORE  ----------//
  public function store(BelanjaRequest $request): RedirectResponse
  {
    Gate::authorize('update', Belanja::class);

    $query = $this->service->store($request);
    if ($query)
      return to_route('belanja.index')->with('success', 'Data berhasil ditambahkan.');

    return to_route('belanja.index');
  }

  //----------  EDIT  ----------//
  public function edit(string $pivot): View
  {
    Gate::authorize('update', Belanja::class);

    return view('belanja.edit', [
      'data' => $this->service->find_pivot($pivot),
    ]);
  }

  //----------  UPDATE  ----------//
  public function update($pivot, BelanjaUpdateRequest $request): RedirectResponse
  {
    Gate::authorize('update', Belanja::class);

    $query = $this->service->update($pivot, $request);
    if ($query)
      return to_route('belanja.index')->with('success', 'Data berhasil diubah.');

    return to_route('belanja.index');
  }

}
