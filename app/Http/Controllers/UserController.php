<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\Datatables\UserTableService;
use App\Services\UnitService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
  public function __construct(
    protected UserService $service
  ) {
    $this->middleware('permission:user create')->only(['create', 'store']);
    $this->middleware('permission:user read')->only(['index', 'datatable']);
    $this->middleware('permission:user update')->only(['edit', 'update']);
    $this->middleware('permission:user delete')->only(['destroy']);
    $this->middleware('permission:user multidelete')->only(['multdelete']);
  }

  //----------  INDEX  ----------//
  public function index(): View
  {
    return view('user.index');
  }

  //----------  DATATABLE  ----------//
  public function datatable(): JsonResponse
  {
    return app(UserTableService::class)->table();
  }

  //----------  CREATE  ----------//
  public function create(): View
  {
    return view('user.create', [
      'units' => app(UnitService::class)->getAll()
    ]);
  }

  //----------  STORE  ----------//
  public function store(UserRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query)
      return redirect()->route('user.index')->with('success', '<b>' . $query->name . '</b> berhasil ditambahkan.');

    return redirect()->route('user.index')->with('error', 'User gagal ditambahkan.');
  }

  //----------  EDIT  ----------//
  public function edit($user): View
  {
    return view('user.edit', [
      'data' => $this->service->find($user),
      'units' => app(UnitService::class)->getAll(),
    ]);
  }

  //----------  UPDATE  ----------//
  public function update($user, UserRequest $request): RedirectResponse
  {
    $query = $this->service->update($user, $request);
    if ($query)
      return redirect()->route('user.index')->with('success', '<b>' . $query->name . '</b> berhasil diubah.');

    return redirect()->route('user.index');
  }

  //----------  DESTROY  ----------//
  public function destroy($user): JsonResponse
  {
    try {
      $this->service->delete($user);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }

  //----------  MULTDELETE  ----------//
  public function multdelete(Request $request): JsonResponse
  {
    try {
      $this->service->multipleDelete($request->post('ids'));
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }
}
