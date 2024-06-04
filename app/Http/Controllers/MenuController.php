<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Services\Datatables\MenuTableService;
use App\Services\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MenuController extends Controller
{
  public function __construct(
    protected MenuService $service
  ) {
    $this->middleware('permission:menu create')->only(['create', 'store']);
    $this->middleware('permission:menu read')->only(['index', 'datatable']);
    $this->middleware('permission:menu update')->only(['edit', 'update']);
    $this->middleware('permission:menu delete')->only(['destroy']);
  }

  public function index(): View
  {
    return view('menu.index');
  }

  public function datatable(MenuTableService $datatable): JsonResponse
  {
    return $datatable->table();
  }

  public function create(): View
  {
    return view('menu.create');
  }

  public function store(MenuRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('menu.index')->with('success', '<b>' . $query->name . '</b> berhasil ditambahkan.');

    return redirect()->route('menu.index');
  }

  public function edit($menu): View
  {
    return view('menu.edit', [
      'data' => $this->service->find($menu)
    ]);
  }

  public function update($menu, MenuRequest $request): RedirectResponse
  {
    $query = $this->service->update($menu, $request);
    if ($query)
      return redirect()->route('menu.index')->with('success', '<b>' . $query->name . '</b> berhasil diubah.');

    return redirect()->route('menu.index');
  }

  public function destroy($menu): JsonResponse
  {
    try {
      $this->service->delete($menu);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }
}
