<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidangRequest;
use App\Services\BidangService;
use App\Services\Datatables\BidangTableService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BidangController extends Controller
{
  public function __construct(
    protected BidangService $service
  ) {
    $this->middleware('permission:bidang create')->only(['create', 'store']);
    $this->middleware('permission:bidang read')->only(['index', 'datatable', 'createUnits']);
    $this->middleware('permission:bidang unit')->only(['syncUnits']);
    $this->middleware('permission:bidang update')->only(['edit', 'update']);
    $this->middleware('permission:bidang delete')->only(['destroy']);
  }

  public function index(): View
  {
    return view('bidang.index');
  }

  public function datatable(BidangTableService $datatable): JsonResponse
  {
    return $datatable->table();
  }

  public function createUnits($bidang): View
  {
    return view('bidang.units', $this->service->createUnits($bidang));
  }

  public function syncUnits($bidang, Request $request): RedirectResponse
  {
    $query = $this->service->syncUnits($bidang, $request->units ?? []);
    if ($query)
      return redirect()->route('bidang.index')->with('success', 'berhasil sinkron.');

    return redirect()->route('bidang.index');
  }

  public function create(): View
  {
    return view('bidang.create');
  }

  public function store(BidangRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('bidang.index')->with('success', '<b>' . $query->name . '</b> berhasil ditambahkan.');

    return redirect()->route('bidang.index');
  }

  public function edit($role): View
  {
    return view('bidang.edit', [
      'data' => $this->service->find($role)
    ]);
  }

  public function update($role, BidangRequest $request): RedirectResponse
  {
    $query = $this->service->update($role, $request);
    if ($query)
      return redirect()->route('bidang.index')->with('success', '<b>' . $query->name . '</b> berhasil diubah.');

    return redirect()->route('bidang.index');
  }

  public function destroy($role): JsonResponse
  {
    try {
      $this->service->delete($role);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }
}
