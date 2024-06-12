<?php

namespace App\Http\Controllers;

use App\Http\Requests\BelanjaRequest;
use App\Services\BelanjaService;
use App\Services\Datatables\BelanjaTableService;
use App\Services\JenbelService;
use App\Services\PerencanaanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BelanjaController extends Controller
{
  public function __construct(
    protected BelanjaService $service
  ) {
    // $this->middleware('permission:perencanaan create')->only(['create', 'store']);
    // $this->middleware('permission:perencanaan read')->only(['index', 'datatable']);
    // $this->middleware('permission:perencanaan delete')->only(['destroy']);
    // $this->middleware('permission:perencanaan multidelete')->only(['multdelete']);
  }

  //----------  INDEX  ----------//
  public function index()//: View|RedirectResponse
  {
    $perencanaan = app(PerencanaanService::class)->find(Session::get('rbelanja') ?? "x");
    if (!$perencanaan)
      return redirect()->route('perencanaan.index');

    return view('belanja.index', [
      'belanjas' => $this->service->table(Session::get('rbelanja')),
      'data' => $perencanaan,
    ]);
  }

  //----------  CREATE  ----------//
  public function create()//: View
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

  //----------  DETAIL  ----------//
  public function detail(string $belanja): RedirectResponse
  {
    Session::put('rbarang', $belanja);
    return redirect()->route('detailbelanja.index');
  }

}
