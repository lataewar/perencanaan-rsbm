<?php

namespace App\Policies;

use App\Enums\StatusEnum;
use App\Models\User;
use App\Services\PerencanaanService;
use Illuminate\Support\Facades\Session;

class BelanjaPolicy
{
  public function update(User $user): bool
  {
    if (!Session::has('perencanaan_id'))
      return false;

    $find = app(PerencanaanService::class)->find_usulan(Session::get('perencanaan_id'));
    $status = StatusEnum::from($find->status);

    // if status == dikirim && role_id == perencana
    if ($status->isDikirim() && $user->role_id->isPerencana())
      return true;

    return false;
  }
}
