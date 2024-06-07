<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerencanaanRequest;
use App\Services\Datatables\PerencanaanTableService;
use App\Services\PerencanaanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PerencanaanController extends Controller
{
  public function __construct(
    protected PerencanaanService $service
  ) {
    // $this->middleware('permission:perencanaan create')->only(['create', 'store']);
    // $this->middleware('permission:perencanaan read')->only(['index', 'datatable']);
    // $this->middleware('permission:perencanaan update')->only(['edit', 'update']);
    // $this->middleware('permission:perencanaan delete')->only(['destroy']);
    // $this->middleware('permission:perencanaan multidelete')->only(['multdelete']);
  }

  //----------  INDEX  ----------//
  public function index(): View
  {
    return view('perencanaan.index');
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return app(PerencanaanTableService::class)->table();
  }

  //----------  CREATE  ----------//
  public function create(): View
  {
    return view('perencanaan.create');
  }

  //----------  STORE  ----------//
  public function store(PerencanaanRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('perencanaan.index')->with('success', '<b>' . $query->u_name . '</b> berhasil ditambahkan.');

    return redirect()->route('perencanaan.index');
  }
}
