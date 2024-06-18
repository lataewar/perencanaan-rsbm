<?php

namespace App\Http\Controllers;

use App\Http\Requests\BelanjaRequest;
use App\Services\BelanjaService;
use App\Services\JenbelService;
use App\Services\PerencanaanService;
use Illuminate\Http\RedirectResponse;
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
      redirect()->route('perencanaan.index');
  }

  //----------  INDEX  ----------//
  public function index(): View
  {
    return view('belanja.index', [
      'belanjas' => $this->service->table(Session::get('perencanaan_id')),
      'data' => app(PerencanaanService::class)->find_total(Session::get('perencanaan_id')),
    ]);
  }

  //----------  CREATE  ----------//
  public function create(): View
  {
    return view('belanja.create', [
      'jenbels' => app(JenbelService::class)->getALlByLevel(3),
    ]);
  }

  //----------  STORE  ----------//
  public function store(BelanjaRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('belanja.index')->with('success', 'Data berhasil ditambahkan.');

    return redirect()->route('belanja.index');
  }

  //----------  EDIT  ----------//
  public function edit(string $id): View
  {
    return view('belanja.edit', [
      'data' => $this->service->find_edit($id),
    ]);
  }

  //----------  UPDATE  ----------//
  public function update(string $id, BelanjaRequest $request): RedirectResponse
  {
    $query = $this->service->update($id, $request);
    if ($query)
      return redirect()->route('belanja.index')->with('success', 'Data berhasil diubah.');

    return redirect()->route('belanja.index');
  }

  //----------  DETAIL  ----------//
  public function detail(string $belanja): RedirectResponse
  {
    Session::put('belanja_id', $belanja);
    return redirect()->route('detailbelanja.index');
  }

  //----------  DESTROY  ----------//
  public function destroy(string $belanja): RedirectResponse
  {
    $query = $this->service->delete($belanja);
    if ($query)
      return redirect()->route('belanja.index')->with('success', 'Data berhasil dihapus.');

    return redirect()->route('belanja.index')->with('error', 'Data gagal dihapus.');
  }

}
