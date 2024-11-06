<?php

namespace App\Policies;

use App\Models\Perencanaan;
use App\Models\User;
use App\Services\PeriodeService;
use Illuminate\Auth\Access\Response;

class PerencanaanPolicy
{

  public function validasi(User $user, Perencanaan $perencanaan): bool
  {
    // Can only be done by Bidang AND last status must be dikirim
    if (!$user->role_id->isBidang() || !$perencanaan->last_status->status->isDikirim())
      return false;

    // Check if unit is belongs to user bidang
    return $perencanaan->unit->isPartOfBidang($user->bidang_id);
  }

  public function accept(User $user, Perencanaan $perencanaan): bool
  {
    // Can only be done by Perencana AND last status must be validated
    if (!$user->role_id->isPerencana() || !$perencanaan->last_status->status->isDivalidasi())
      return false;

    return true;
  }

  public function reject(User $user, Perencanaan $perencanaan): bool
  {
    $status = $perencanaan->last_status->status;

    if ($user->role_id->isPerencana()) { // Cek Role is_perencana
      if (!$status->isDivalidasi())
        return false;
    } else if ($user->role_id->isBidang()) { // Cek Role is_bidang
      if (!$status->isDikirim())
        return false;
    }

    return true;
  }

  public function is_periode_aktif(User $user, Perencanaan $perencanaan): bool
  {
    return app(PeriodeService::class)->checkIfActiveByTahunPeriode($perencanaan->p_tahun, $perencanaan->p_periode);
  }

}
