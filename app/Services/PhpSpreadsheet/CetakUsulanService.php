<?php

namespace App\Services\PhpSpreadsheet;

use App\Enums\StatusEnum;
use App\Services\PerencanaanService;
use App\Services\UsulanService;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class CetakUsulanService extends PhpSpreadsheetService
{
  public function __construct(
  ) {
  }

  public function cetak(string $id): void
  {
    $rencana = app(PerencanaanService::class)->find_usulan($id);

    $filename = 'usulan_' . Str::slug($rencana->u_name, '-') . '_tahun_' . $rencana->p_tahun;
    $unit = Str::upper($rencana->u_name);
    $status = 'Status Usulan : ' . StatusEnum::from($rencana->status)->getLabelText();

    $usulans = app(UsulanService::class)->table($id);

    $spreadsheet = new Spreadsheet();

    $spreadsheet->getActiveSheet()->freezePane('A7');
    $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
    $spreadsheet->getActiveSheet()->setCellValue('A1', 'USULAN KEBUTUHAN TAHUN ' . $rencana->p_tahun);
    $spreadsheet->getActiveSheet()->mergeCells('A2:H2');
    $spreadsheet->getActiveSheet()->mergeCells('A3:H3');
    $spreadsheet->getActiveSheet()->setCellValue('A2', $unit);
    $spreadsheet->getActiveSheet()->setCellValue('A3', $status);
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getFont()->setBold(true);

    $spreadsheet->getActiveSheet()->setCellValue('A5', 'No.');
    $spreadsheet->getActiveSheet()->setCellValue('B5', 'Nama Barang');
    $spreadsheet->getActiveSheet()->setCellValue('C5', 'Jumlah');
    $spreadsheet->getActiveSheet()->setCellValue('D5', 'Satuan');
    $spreadsheet->getActiveSheet()->setCellValue('E5', 'Harga');
    $spreadsheet->getActiveSheet()->setCellValue('F5', 'Spesifikasi');
    $spreadsheet->getActiveSheet()->setCellValue('G5', 'Keterangan');
    $spreadsheet->getActiveSheet()->setCellValue('H5', 'Total');

    $spreadsheet->getActiveSheet()->setCellValue('A6', '1');
    $spreadsheet->getActiveSheet()->setCellValue('B6', '2');
    $spreadsheet->getActiveSheet()->setCellValue('C6', '3');
    $spreadsheet->getActiveSheet()->setCellValue('D6', '4');
    $spreadsheet->getActiveSheet()->setCellValue('E6', '5');
    $spreadsheet->getActiveSheet()->setCellValue('F6', '6');
    $spreadsheet->getActiveSheet()->setCellValue('G6', '7');
    $spreadsheet->getActiveSheet()->setCellValue('H6', '8 (3x5)');
    $spreadsheet->getActiveSheet()->getStyle('A5:H5')->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('A5:H6')->applyFromArray($this->lineTitle);
    $spreadsheet->getActiveSheet()->getStyle('A5:H5')->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getStyle('A5:H5')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('a8a8a8');
    $spreadsheet->getActiveSheet()->getStyle('A6:H6')->getFont()->setSize(8);

    $spreadsheet->getActiveSheet()->getStyle('A5:H6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A5:H6')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A5:H5')->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('A5:H6')->getFont()->setItalic(true);

    $spreadsheet->getActiveSheet()->getRowDimension('5')->setRowHeight(30, 'pt');
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(80);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(25);

    $no = 7;
    $hit = 1;
    $tot_harga = 0;
    $tot_jumlah = 0;
    foreach ($usulans as $data) {

      $spreadsheet->getActiveSheet()->setCellValue('A' . $no, $hit);
      $spreadsheet->getActiveSheet()->setCellValue('B' . $no, $data->ul_name);
      $spreadsheet->getActiveSheet()->setCellValue('C' . $no, $data->ul_qty);
      $spreadsheet->getActiveSheet()->setCellValue('D' . $no, "");
      $spreadsheet->getActiveSheet()->setCellValue('E' . $no, $data->ul_prise);
      $spreadsheet->getActiveSheet()->setCellValue('F' . $no, $data->ul_desc);
      $spreadsheet->getActiveSheet()->setCellValue('G' . $no, "");
      $spreadsheet->getActiveSheet()->setCellValue('H' . $no, $data->ul_qty * $data->ul_prise);

      $tot_jumlah += $data->ul_qty;
      $tot_harga += $data->ul_qty * $data->ul_prise;
      $no++;
      $hit++;
    }

    $spreadsheet->getActiveSheet()->getStyle('A7:H' . ($no - 1))->applyFromArray($this->lineIsiTabel);

    $spreadsheet->getActiveSheet()->getStyle('A7:H' . ($no - 1))->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
    $spreadsheet->getActiveSheet()->getStyle('A7:A' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getStyle('A7:H' . ($no - 1))->getAlignment()->setWrapText(true);

    $spreadsheet->getActiveSheet()->getStyle('A7:A' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('C7:C' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('C7:C' . $no)->getNumberFormat()->setFormatCode('#,##0');
    $spreadsheet->getActiveSheet()->getStyle('E7:E' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    $spreadsheet->getActiveSheet()->getStyle('E7:E' . $no)->getNumberFormat()->setFormatCode('#,##0');
    $spreadsheet->getActiveSheet()->getStyle('H7:H' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    $spreadsheet->getActiveSheet()->getStyle('H7:H' . $no)->getNumberFormat()->setFormatCode('#,##0');
    $spreadsheet->getActiveSheet()->getStyle('F7:G' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getStyle('H7:H' . $no)->getFont()->setBold(true);

    $spreadsheet->getActiveSheet()->setCellValue('C' . $no, $tot_jumlah);
    $spreadsheet->getActiveSheet()->setCellValue('H' . $no, $tot_harga);

    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':H' . $no)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('a8a8a8');
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':H' . $no)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':H' . $no)->getFont()->setItalic(true);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':H' . $no)->applyFromArray($this->lineJumlah);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':H' . $no)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':B' . $no)->applyFromArray($this->lineNoVertical);

    // ob_end_clean();
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    header('Cache-Control: max-age=0');

    setlocale(LC_ALL, 'en_US');
    $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
    $writer->save('php://output');
    die();
  }
}
