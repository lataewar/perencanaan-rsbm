<?php

namespace App\Services\PhpSpreadsheet;

use App\Models\SuratMasuk;
use App\Repositories\KodeInstansiRepository;
use App\Repositories\SuratMasukRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use stdClass;

class CetakSuratMasukService extends PhpSpreadsheetService
{
  public function __construct(
    protected SuratMasukRepository $repository
  ) {
  }

  public function cetak(stdClass $request): void
  {
    $from = Carbon::parse($request->start)->startOfDay();
    $to = Carbon::parse($request->end)->startOfDay();

    $filename = 'Rekap_surat_masuk_' . $request->start . '_to_' . $request->end;
    $instansi = Str::upper(app(KodeInstansiRepository::class)->first()->desc ?? 'INSTANSI');
    $periode = 'PERIODE ' . formatTanggal($request->start) . ' SAMPAI DENGAN ' . formatTanggal($request->end);

    $datas = $this->repository->getdataBetween($from, $to);

    $spreadsheet = new Spreadsheet();

    $spreadsheet->getActiveSheet()->freezePane('A6');
    $spreadsheet->getActiveSheet()->mergeCells('A1:F1');
    $spreadsheet->getActiveSheet()->setCellValue('A1', $instansi);
    $spreadsheet->getActiveSheet()->mergeCells('A2:F2');
    $spreadsheet->getActiveSheet()->mergeCells('A3:F3');
    $spreadsheet->getActiveSheet()->setCellValue('A2', 'REKAP SURAT MASUK');
    $spreadsheet->getActiveSheet()->setCellValue('A3', strtoupper($periode));
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getFont()->setBold(true);

    $spreadsheet->getActiveSheet()->setCellValue('A5', 'NO');
    $spreadsheet->getActiveSheet()->setCellValue('B5', 'NOMOR SURAT');
    $spreadsheet->getActiveSheet()->setCellValue('C5', 'PERIHAL');
    $spreadsheet->getActiveSheet()->setCellValue('D5', 'TANGGAL');
    $spreadsheet->getActiveSheet()->setCellValue('E5', 'ASAL');
    $spreadsheet->getActiveSheet()->setCellValue('F5', 'TUJUAN');

    $spreadsheet->getActiveSheet()->setCellValue('A6', '1');
    $spreadsheet->getActiveSheet()->setCellValue('B6', '2');
    $spreadsheet->getActiveSheet()->setCellValue('C6', '3');
    $spreadsheet->getActiveSheet()->setCellValue('D6', '4');
    $spreadsheet->getActiveSheet()->setCellValue('E6', '5');
    $spreadsheet->getActiveSheet()->setCellValue('F6', '5');
    $spreadsheet->getActiveSheet()->getStyle('A5:F5')->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('A5:F6')->applyFromArray($this->lineTitle);
    $spreadsheet->getActiveSheet()->getStyle('A5:F5')->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getStyle('A6:F6')->getFont()->setSize(8);
    $spreadsheet->getActiveSheet()->getStyle('A6:F6')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('ADADAD');

    $spreadsheet->getActiveSheet()->getStyle('A5:F6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A5:F6')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A5:F5')->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('A5:F6')->getFont()->setItalic(true);

    $spreadsheet->getActiveSheet()->getRowDimension('5')->setRowHeight(20, 'pt');
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(100);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30);

    $no = 7;
    $hit = 1;
    foreach ($datas as $data) {
      $spreadsheet->getActiveSheet()->setCellValue('A' . $no, $hit++);
      $spreadsheet->getActiveSheet()->setCellValue('B' . $no, $data->nomor);
      $spreadsheet->getActiveSheet()->setCellValue('C' . $no, $data->perihal);
      $spreadsheet->getActiveSheet()->setCellValue('D' . $no, $data->date);
      $spreadsheet->getActiveSheet()->setCellValue('E' . $no, $data->asal);
      $spreadsheet->getActiveSheet()->setCellValue('F' . $no, $data->satker->name);
      $no++;
    }

    $spreadsheet->getActiveSheet()->getStyle('A7:F' . ($no - 1))->applyFromArray($this->lineIsiTabel);
    $spreadsheet->getActiveSheet()->getStyle('A7:B' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('D7:D' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A7:F' . ($no - 1))->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
    $spreadsheet->getActiveSheet()->getStyle('C7:C' . ($no - 1))->getAlignment()->setWrapText(true);

    $spreadsheet->getActiveSheet()->mergeCells('A' . $no . ':F' . $no);
    $spreadsheet->getActiveSheet()->setCellValue('A' . $no, 'JUMLAH SURAT MASUK : ' . count($datas));

    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':F' . $no)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('C9C9C9');
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':F' . $no)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':F' . $no)->getFont()->setItalic(true);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':F' . $no)->applyFromArray($this->lineJumlah);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':F' . $no)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

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
