<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use stdClass;

class UserRepository extends BaseRepository
{
  public function __construct(User $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder|Model
  {
    return $this->model->orderBy('created_at');
  }

  public function store(stdClass $request): ?Model
  {
    DB::beginTransaction();

    try {
      $user = $this->model->create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $request->role_id,
        'unit_id' => $request->unit_id,
        'bidang_id' => $request->bidang_id,
      ]);
      $user->syncRoles((int) $request->role_id);

      DB::commit();
      return $user;
    } catch (\Exception $e) {
      DB::rollback();
      return null;
    }
  }

  public function update(string $id, stdClass $request): ?Model
  {
    DB::beginTransaction();

    try {
      $user = tap($this->find($id))->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'role_id' => $request->role_id,
        'unit_id' => $request->unit_id,
        'bidang_id' => $request->bidang_id,
      ]);
      $user->syncRoles((int) $request->role_id);

      DB::commit();
      return $user;
    } catch (\Exception $e) {
      DB::rollback();
      return null;
    }
  }

  public function updateWithoutPwd(string $id, stdClass $request): ?Model
  {
    DB::beginTransaction();

    try {
      $user = tap($this->find($id))->update([
        'name' => $request->name,
        'email' => $request->email,
        'role_id' => $request->role_id,
        'unit_id' => $request->unit_id,
        'bidang_id' => $request->bidang_id,
      ]);
      $user->syncRoles((int) $request->role_id);

      DB::commit();
      return $user;
    } catch (\Exception $e) {
      DB::rollback();
      return null;
    }
  }
}
