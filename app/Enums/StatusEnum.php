<?php

namespace App\Enums;

enum StatusEnum: int
{
  case DRAFT = 1;
  case DIKIRIM = 2;
  case DIVALIDASI = 3;
  case DISETUJUI = 4;
  case DITOLAK = 5;

  public static function toArray(): array
  {
    $data = [];
    foreach (self::cases() as $case) {
      array_push($data, ['id' => $case->value, 'name' => $case->getLabelText()]);
    }
    return $data;
  }

  public function isDraft(): bool
  {
    return $this === self::DRAFT;
  }

  public function isDikirim(): bool
  {
    return $this === self::DIKIRIM;
  }

  public function isDivalidasi(): bool
  {
    return $this === self::DIVALIDASI;
  }

  public function isDisetujui(): bool
  {
    return $this === self::DISETUJUI;
  }

  public function isDitolak(): bool
  {
    return $this === self::DITOLAK;
  }

  public function getName(): string
  {
    return match ($this) {
      self::DRAFT => "draft",
      self::DIKIRIM => "dikirim",
      self::DIVALIDASI => "divalidasi",
      self::DISETUJUI => "disetujui",
      self::DITOLAK => "ditolak",
    };
  }

  public function getLabelText(): string
  {
    return match ($this) {
      self::DRAFT => "Draft",
      self::DIKIRIM => "Dikirim",
      self::DIVALIDASI => "Divalidasi",
      self::DISETUJUI => "Disetujui",
      self::DITOLAK => "Ditolak",
    };
  }

  public function getLabelColor(): string
  {
    return match ($this) {
      self::DRAFT => "dark",
      self::DIKIRIM => "primary",
      self::DIVALIDASI => "info",
      self::DISETUJUI => "success",
      self::DITOLAK => "danger",
    };
  }

  public function getLabelHTML(): string
  {
    return sprintf(
      "<span class='label label-light-%s font-weight-bold label-inline'>%s</span>",
      $this->getLabelColor(),
      $this->getLabelText()
    );
  }
}
