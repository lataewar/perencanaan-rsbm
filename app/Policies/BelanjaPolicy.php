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

    $find = app(PerencanaanService::class)->find_total(Session::get('perencanaan_id'));
    $status = StatusEnum::from($find->status);

    // if status == draft || ditolak && role_id == unit
    if (($status->isDraft() || $status->isDitolak()) && $user->role_id->isUnit())
      return true;

    // if status == dikirim && role_id == perencana
    if ($status->isDikirim() && $user->role_id->isPerencana())
      return true;

    return false;
  }
}
