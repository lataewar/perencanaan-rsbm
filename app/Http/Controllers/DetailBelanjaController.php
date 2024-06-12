<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailBelanjaRequest;
use App\Services\BarangService;
use App\Services\DetailBelanjaService;
use App\Services\Datatables\DetailBelanjaTableService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DetailBelanjaController extends Controller
{
  public function __construct(
    protected DetailBelanjaService $service
  ) {
    // $this->middleware('permission:perencanaan create')->only(['create', 'store']);
    // $this->middleware('permission:perencanaan read')->only(['index', 'datatable']);
    // $this->middleware('permission:perencanaan delete')->only(['destroy']);
    // $this->middleware('permission:perencanaan multidelete')->only(['multdelete']);
  }

  //----------  INDEX  ----------//
  public function index(): View|RedirectResponse
  {
    $belanja = Session::get('rbarang') ?? null;
    if (!$belanja)
      return redirect()->route('belanja.index');

    return view('detailbelanja.index', [
      'belanja' => $belanja,
    ]);
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return app(DetailBelanjaTableService::class)->table(Session::get('rbelanja') ?? "x");
  }

  //----------  CREATE  ----------//
  public function create()//: View
  {
    return view('detailbelanja.create', [
      'barangs' => app(BarangService::class)->getByBelanja(Session::get('rbarang')),
    ]);
  }

  //----------  STORE  ----------//
  public function store(DetailBelanjaRequest $request)//: RedirectResponse
  {
    return $request->validated();
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('detailbelanja.index')->with('success', 'Data berhasil ditambahkan.');

    return redirect()->route('detailbelanja.index');
  }

}
