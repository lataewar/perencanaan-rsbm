<?php

namespace App\Enums;

enum PrioritasEnum: string
{
  case YA = 'ya';
  case TIDAK = 'tidak';

  public static function toArray(): array
  {
    $data = [];
    foreach (self::cases() as $case) {
      array_push($data, ['id' => $case->value, 'name' => $case->getName()]);
    }
    return $data;
  }

  public function getName(): string
  {
    return match ($this) {
      self::YA => "Ya",
      self::TIDAK => "Tidak",
      default => ''
    };
  }

}
