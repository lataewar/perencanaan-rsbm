<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\Datatables\RoleTableService;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
  public function __construct(
    protected RoleService $service
  ) {
    // $this->middleware('isajaxreq')->except('index');

    $this->middleware('permission:role create')->only(['create', 'store']);
    $this->middleware('permission:role read')->only(['index', 'datatable', 'createAkses', 'createPermission']);
    $this->middleware('permission:role setakses')->only(['syncAkses']);
    $this->middleware('permission:role setpermission')->only(['syncPermission']);
    $this->middleware('permission:role update')->only(['edit', 'update']);
    $this->middleware('permission:role delete')->only(['destroy']);
  }

  public function index(): View
  {
    return view('role.index');
  }

  public function datatable(RoleTableService $datatable): JsonResponse
  {
    return $datatable->table();
  }

  public function createAkses($role): View
  {
    return view('role.akses', $this->service->createAkses($role));
  }

  public function syncAkses($role, Request $request): RedirectResponse
  {
    $query = $this->service->syncAkses($role, $request->menus ?? []);
    if ($query)
      return redirect()->route('role.index')->with('success', 'berhasil mengubah hak akses.');

    return redirect()->route('role.index');
  }

  public function createPermission($role): View
  {
    return view('role.izin', $this->service->createPermission($role));
  }

  public function syncPermission($role, Request $request): RedirectResponse
  {
    if ($this->service->syncPermission($role, $request->permissions ?? []))
      return redirect()->route('role.index')->with('success', 'berhasil mengubah izin.');

    return redirect()->route('role.index');
  }

  public function create(): View
  {
    return view('role.create');
  }

  public function store(RoleRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('role.index')->with('success', '<b>' . $query->name . '</b> berhasil ditambahkan.');

    return redirect()->route('role.index');
  }

  public function edit($role): View
  {
    return view('role.edit', [
      'data' => $this->service->find($role)
    ]);
  }

  public function update($role, RoleRequest $request): RedirectResponse
  {
    $query = $this->service->update($role, $request);
    if ($query)
      return redirect()->route('role.index')->with('success', '<b>' . $query->name . '</b> berhasil diubah.');

    return redirect()->route('role.index');
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
