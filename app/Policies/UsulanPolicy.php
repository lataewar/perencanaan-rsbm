<?php

namespace App\Policies;

use App\Enums\StatusEnum;
use App\Models\User;
use App\Models\Usulan;
use App\Services\PerencanaanService;
use Illuminate\Support\Facades\Session;

class UsulanPolicy
{

  public function update(User $user): bool
  {
    if (!Session::has('usulan'))
      return false;

    $find = app(PerencanaanService::class)->find_usulan(Session::get('usulan'));
    $status = StatusEnum::from($find->status);

    // if status == draft || ditolak && role_id == unit
    if (($status->isDraft() || $status->isDitolak()) && $user->role_id->isUnit())
      return true;

    return false;
  }

}
