<?php

namespace App\Enums;

enum UserRoleEnum: int
{
  case SUPER_ADMIN = 1;
  case ADMIN = 2;
  case PIMPINAN = 3;
  case PERENCANA = 4;
  case UNIT = 5;

  public static function toArray(): array
  {
    $data = [];
    foreach (self::cases() as $case) {
      array_push($data, ['id' => $case->value, 'name' => $case->getLabelText()]);
    }
    return $data;
  }

  public function isSuperAdmin(): bool
  {
    return $this === self::SUPER_ADMIN;
  }

  public function isAdmin(): bool
  {
    return $this === self::ADMIN;
  }

  public function isPimpinan(): bool
  {
    return $this === self::PIMPINAN;
  }

  public function isPerencana(): bool
  {
    return $this === self::PERENCANA;
  }

  public function isUnit(): bool
  {
    return $this === self::UNIT;
  }

  public function getName(): string
  {
    return match ($this) {
      self::SUPER_ADMIN => "super admin",
      self::ADMIN => "admin",
      self::PIMPINAN => "pimpinan",
      self::PERENCANA => "perencana",
      self::UNIT => "unit",
    };
  }

  public function getLabelText(): string
  {
    return match ($this) {
      self::SUPER_ADMIN => "Super Administrator",
      self::ADMIN => "Administrator",
      self::PIMPINAN => "Pimpinan",
      self::PERENCANA => "Perencana",
      self::UNIT => "Unit",
    };
  }

  private function getLabelColor(): string
  {
    return match ($this) {
      self::SUPER_ADMIN => "danger",
      self::ADMIN => "warning",
      self::PIMPINAN => "info",
      self::PERENCANA => "success",
      self::UNIT => "primary",
    };
  }

  public function getLabelHTML(): string
  {
    return sprintf(
      '<span class="label label-light-%s font-weight-bold label-inline">%s</span>',
      $this->getLabelColor(),
      $this->getLabelText()
    );
  }
}
