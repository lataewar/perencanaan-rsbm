<?php

namespace App\Services\PhpSpreadsheet;

use App\Enums\PrioritasEnum;
use App\Enums\SumberAnggaranEnum;
use App\Services\BelanjaService;
use App\Services\PerencanaanService;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class CetakPerencanaanService extends PhpSpreadsheetService
{
  public function __construct(
  ) {
  }

  public function cetak(string $id): void
  {
    $rencana = app(PerencanaanService::class)->find_total($id);

    $filename = 'perencanaan_' . Str::slug($rencana->u_name, '-') . '_tahun_' . $rencana->p_tahun;
    $unit = Str::upper($rencana->u_name);

    $belanjas = app(BelanjaService::class)->table($id);

    $spreadsheet = new Spreadsheet();

    $spreadsheet->getActiveSheet()->freezePane('A7');
    $spreadsheet->getActiveSheet()->mergeCells('A1:K1');
    $spreadsheet->getActiveSheet()->setCellValue('A1', 'PERENCANAAN TAHUN ' . $rencana->p_tahun);
    $spreadsheet->getActiveSheet()->mergeCells('A2:K2');
    $spreadsheet->getActiveSheet()->mergeCells('A3:K3');
    $spreadsheet->getActiveSheet()->setCellValue('A2', $unit);
    $spreadsheet->getActiveSheet()->setCellValue('A3', "");
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getFont()->setBold(true);

    $spreadsheet->getActiveSheet()->setCellValue('A5', 'Kode Rekening');
    $spreadsheet->getActiveSheet()->mergeCells('B5:C5');
    $spreadsheet->getActiveSheet()->setCellValue('B5', 'Jenis');
    $spreadsheet->getActiveSheet()->setCellValue('D5', 'Jumlah');
    $spreadsheet->getActiveSheet()->setCellValue('E5', 'Satuan');
    $spreadsheet->getActiveSheet()->setCellValue('F5', 'Harga');
    $spreadsheet->getActiveSheet()->setCellValue('G5', 'Spesifikasi');
    $spreadsheet->getActiveSheet()->setCellValue('H5', 'Prioritas');
    $spreadsheet->getActiveSheet()->setCellValue('I5', 'Sumber Anggaran');
    $spreadsheet->getActiveSheet()->setCellValue('J5', 'Keterangan');
    $spreadsheet->getActiveSheet()->setCellValue('K5', 'Total');

    $spreadsheet->getActiveSheet()->setCellValue('A6', '1');
    $spreadsheet->getActiveSheet()->mergeCells('B6:C6');
    $spreadsheet->getActiveSheet()->setCellValue('B6', '2');
    $spreadsheet->getActiveSheet()->setCellValue('D6', '3');
    $spreadsheet->getActiveSheet()->setCellValue('E6', '4');
    $spreadsheet->getActiveSheet()->setCellValue('F6', '5');
    $spreadsheet->getActiveSheet()->setCellValue('G6', '6');
    $spreadsheet->getActiveSheet()->setCellValue('H6', '7');
    $spreadsheet->getActiveSheet()->setCellValue('I6', '8');
    $spreadsheet->getActiveSheet()->setCellValue('J6', '9');
    $spreadsheet->getActiveSheet()->setCellValue('K6', '10 (3x5)');
    $spreadsheet->getActiveSheet()->getStyle('A5:K5')->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('A5:K6')->applyFromArray($this->lineTitle);
    $spreadsheet->getActiveSheet()->getStyle('A5:K5')->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getStyle('A5:K5')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('a8a8a8');
    $spreadsheet->getActiveSheet()->getStyle('A6:K6')->getFont()->setSize(8);

    $spreadsheet->getActiveSheet()->getStyle('A5:K6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A5:K6')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A5:K5')->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('A5:K6')->getFont()->setItalic(true);

    $spreadsheet->getActiveSheet()->getRowDimension('5')->setRowHeight(30, 'pt');
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(4);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(80);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(25);

    $no = 7;
    $tot_jumlah = 0;
    $line_no_vertical = [];
    foreach ($belanjas as $data) {
      $spreadsheet->getActiveSheet()->setCellValue('A' . $no, $data->jb_fullkode);
      $spreadsheet->getActiveSheet()->mergeCells('B' . $no . ':C' . $no);
      $spreadsheet->getActiveSheet()->setCellValue('B' . $no, Str::upper($data->jb_name));
      $spreadsheet->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
      $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':B' . $no)->getFont()->setBold(true);
      $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':K' . $no)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('dddddd');
      $no++;
      foreach ($data->jenis_belanjas as $data2) {
        $spreadsheet->getActiveSheet()->setCellValue('A' . $no, $data2->jb_fullkode);
        $spreadsheet->getActiveSheet()->mergeCells('B' . $no . ':C' . $no);
        $spreadsheet->getActiveSheet()->setCellValue('B' . $no, Str::upper($data2->jb_name));
        $spreadsheet->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':B' . $no)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':K' . $no)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('efefef');
        $no++;
        foreach ($data2->jenis_belanjas as $data3) {
          $spreadsheet->getActiveSheet()->setCellValue('A' . $no, $data3->jb_fullkode);
          $spreadsheet->getActiveSheet()->mergeCells('B' . $no . ':C' . $no);
          $spreadsheet->getActiveSheet()->setCellValue('B' . $no, $data3->jb_name);
          $spreadsheet->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
          $no++;
          $hit = 1;
          foreach ($data3->barangs as $barang) {
            $sp = $barang->pivot->skala_prioritas ? PrioritasEnum::from($barang->pivot->skala_prioritas)->getName() : '';
            $sa = $barang->pivot->sumber_anggaran ? SumberAnggaranEnum::from($barang->pivot->sumber_anggaran)->getName() : '';
            array_push($line_no_vertical, 'B' . $no . ':C' . $no);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $no, $hit);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $no, $barang->br_name);
            $spreadsheet->getActiveSheet()->getStyle('B' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('C' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $no, $barang->pivot->jumlah);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $no, $barang->br_satuan);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $no, $barang->pivot->harga);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $no, $barang->pivot->desc);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $no, $sp);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $no, $sa);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $no, $barang->pivot->message);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $no, $barang->pivot->jumlah * $barang->pivot->harga);

            if ($barang->pivot->is_exist)
              $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':K' . $no)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('fccdd2');

            $tot_jumlah += $barang->pivot->jumlah;
            $no++;
            $hit++;
          }
        }
      }
    }

    $spreadsheet->getActiveSheet()->getStyle('A7:K' . ($no - 1))->applyFromArray($this->lineIsiTabel);
    foreach ($line_no_vertical as $arr) {
      $spreadsheet->getActiveSheet()->getStyle($arr)->applyFromArray($this->lineNoVertical);
    }
    $spreadsheet->getActiveSheet()->getStyle('A7:K' . ($no - 1))->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
    $spreadsheet->getActiveSheet()->getStyle('A7:A' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getStyle('A7:K' . ($no - 1))->getAlignment()->setWrapText(true);

    $spreadsheet->getActiveSheet()->getStyle('D7:D' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('D7:D' . $no)->getNumberFormat()->setFormatCode('#,##0');
    $spreadsheet->getActiveSheet()->getStyle('F7:F' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    $spreadsheet->getActiveSheet()->getStyle('F7:F' . $no)->getNumberFormat()->setFormatCode('#,##0');
    $spreadsheet->getActiveSheet()->getStyle('K7:K' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    $spreadsheet->getActiveSheet()->getStyle('K7:K' . $no)->getNumberFormat()->setFormatCode('#,##0');
    $spreadsheet->getActiveSheet()->getStyle('G7:G' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getStyle('H7:I' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('J7:J' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getStyle('K7:K' . $no)->getFont()->setBold(true);

    $spreadsheet->getActiveSheet()->setCellValue('D' . $no, $tot_jumlah);
    $spreadsheet->getActiveSheet()->setCellValue('K' . $no, $rencana->total);

    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':K' . $no)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('a8a8a8');
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':K' . $no)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':K' . $no)->getFont()->setItalic(true);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':K' . $no)->applyFromArray($this->lineJumlah);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':K' . $no)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('B' . $no . ':C' . $no)->applyFromArray($this->lineNoVertical);

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
