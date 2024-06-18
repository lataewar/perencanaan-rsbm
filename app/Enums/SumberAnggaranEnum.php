<?php

namespace App\Enums;

enum SumberAnggaranEnum: int
{
  case APBD = 1;
  case DAK = 2;
  case APBDPAD = 3;
  case BLUD = 4;
  case HIBAH = 5;
  case LAINNYA = 6;

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
      self::APBD => "APBD",
      self::DAK => "DAK",
      self::APBDPAD => "APBD PAD",
      self::BLUD => "BLUD",
      self::HIBAH => "HIBAH",
      self::LAINNYA => "LAINNYA",
      default => ''
    };
  }

}
