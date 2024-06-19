<?php

namespace App\Http\Controllers;

use App\Http\Requests\BelanjaRequest;
use App\Models\Belanja;
use App\Services\BelanjaService;
use App\Services\JenbelService;
use App\Services\PerencanaanService;
use Illuminate\Http\RedirectResponse;
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

    if (!Session::get('perencanaan_id'))
      to_route('perencanaan.index');
  }

  //----------  INDEX  ----------//
  public function index(): View|RedirectResponse
  {
    return view('belanja.index', [
      'belanjas' => $this->service->table(Session::get('perencanaan_id') ?? 'x'),
      'data' => app(PerencanaanService::class)->find_total(Session::get('perencanaan_id') ?? 'x'),
    ]);
  }

  //----------  CREATE  ----------//
  public function create(): View
  {
    Gate::authorize('update', Belanja::class);

    return view('belanja.create', [
      'jenbels' => app(JenbelService::class)->getALlByLevel(3),
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
  public function edit(string $id): View
  {
    Gate::authorize('update', Belanja::class);

    return view('belanja.edit', [
      'data' => $this->service->find_edit($id),
    ]);
  }

  //----------  UPDATE  ----------//
  public function update(string $id, BelanjaRequest $request): RedirectResponse
  {
    Gate::authorize('update', Belanja::class);

    $query = $this->service->update($id, $request);
    if ($query)
      return to_route('belanja.index')->with('success', 'Data berhasil diubah.');

    return to_route('belanja.index');
  }

  //----------  DETAIL  ----------//
  public function detail(string $belanja): RedirectResponse
  {
    Session::put('belanja_id', $belanja);
    return to_route('detailbelanja.index');
  }

  //----------  DESTROY  ----------//
  public function destroy(string $belanja): RedirectResponse
  {
    Gate::authorize('update', Belanja::class);

    $query = $this->service->delete($belanja);
    if ($query)
      return to_route('belanja.index')->with('success', 'Data berhasil dihapus.');

    return to_route('belanja.index')->with('error', 'Data gagal dihapus.');
  }

}
