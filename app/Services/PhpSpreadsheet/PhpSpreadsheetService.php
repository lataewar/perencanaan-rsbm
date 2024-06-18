<?php

namespace App\Services\PhpSpreadsheet;

use PhpOffice\PhpSpreadsheet\Style\Border;

class PhpSpreadsheetService
{
  protected array $lineTitle = [
    'borders' => [
      'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => '0000'],],
      'outline' => ['borderStyle' => Border::BORDER_DOUBLE,],
    ],
  ];

  protected array $lineJumlah = [
    'borders' => [
      'top' => ['borderStyle' => Border::BORDER_THIN,],
      'vertical' => ['borderStyle' => Border::BORDER_THIN,],
      'bottom' => ['borderStyle' => Border::BORDER_DOUBLE,],
      'left' => ['borderStyle' => Border::BORDER_DOUBLE,],
      'right' => ['borderStyle' => Border::BORDER_DOUBLE,],
    ],
  ];

  protected array $lineIsiTabel = [
    'borders' => [
      'vertical' => ['borderStyle' => Border::BORDER_THIN,],
      'horizontal' => ['borderStyle' => Border::BORDER_HAIR,],
      'left' => ['borderStyle' => Border::BORDER_DOUBLE,],
      'right' => ['borderStyle' => Border::BORDER_DOUBLE,],
    ],
  ];
}
