<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsulanController extends Controller
{
  public function __construct(
    protected PerencanaanService $service
  ) {
    $this->middleware('permission:perencanaan create')->only(['create', 'store']);
    $this->middleware('permission:perencanaan send')->only(['send']);
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
}
