<?php

namespace App\Services\PhpSpreadsheet;

use App\Models\SuratKeluar;
use App\Repositories\KodeInstansiRepository;
use App\Repositories\SuratKeluarRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use stdClass;

class CetakSuratKeluarService extends PhpSpreadsheetService
{
  public function __construct(
    protected SuratKeluarRepository $repository
  ) {
  }

  public function cetak(stdClass $request): void
  {
    $from = Carbon::parse($request->start)->startOfDay();
    $to = Carbon::parse($request->end)->startOfDay();

    $filename = 'Rekap_surat_keluar_' . $request->start . '_to_' . $request->end;
    $instansi = Str::upper(app(KodeInstansiRepository::class)->first()->desc ?? 'INSTANSI');
    $periode = 'PERIODE ' . formatTanggal($request->start) . ' SAMPAI DENGAN ' . formatTanggal($request->end);

    $datas = $this->repository->getdataBetween($from, $to);

    $spreadsheet = new Spreadsheet();

    $spreadsheet->getActiveSheet()->freezePane('A6');
    $spreadsheet->getActiveSheet()->mergeCells('A1:E1');
    $spreadsheet->getActiveSheet()->setCellValue('A1', $instansi);
    $spreadsheet->getActiveSheet()->mergeCells('A2:E2');
    $spreadsheet->getActiveSheet()->mergeCells('A3:E3');
    $spreadsheet->getActiveSheet()->setCellValue('A2', 'REKAP SURAT KELUAR');
    $spreadsheet->getActiveSheet()->setCellValue('A3', strtoupper($periode));
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getFont()->setSize(11);
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A1:A3')->getFont()->setBold(true);

    $spreadsheet->getActiveSheet()->setCellValue('A5', 'NO');
    $spreadsheet->getActiveSheet()->setCellValue('B5', 'NOMOR SURAT');
    $spreadsheet->getActiveSheet()->setCellValue('C5', 'PERIHAL');
    $spreadsheet->getActiveSheet()->setCellValue('D5', 'TANGGAL');
    $spreadsheet->getActiveSheet()->setCellValue('E5', 'TUJUAN');

    $spreadsheet->getActiveSheet()->setCellValue('A6', '1');
    $spreadsheet->getActiveSheet()->setCellValue('B6', '2');
    $spreadsheet->getActiveSheet()->setCellValue('C6', '3');
    $spreadsheet->getActiveSheet()->setCellValue('D6', '4');
    $spreadsheet->getActiveSheet()->setCellValue('E6', '5');
    $spreadsheet->getActiveSheet()->getStyle('A5:E5')->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('A5:E6')->applyFromArray($this->lineTitle);
    $spreadsheet->getActiveSheet()->getStyle('A5:E5')->getFont()->setSize(10);
    $spreadsheet->getActiveSheet()->getStyle('A6:E6')->getFont()->setSize(8);
    $spreadsheet->getActiveSheet()->getStyle('A6:E6')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('ADADAD');

    $spreadsheet->getActiveSheet()->getStyle('A5:E6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A5:E6')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A5:E5')->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('A5:E6')->getFont()->setItalic(true);

    $spreadsheet->getActiveSheet()->getRowDimension('5')->setRowHeight(20, 'pt');
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(100);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);

    $no = 7;
    $hit = 1;
    foreach ($datas as $data) {
      $spreadsheet->getActiveSheet()->setCellValue('A' . $no, $hit++);
      $spreadsheet->getActiveSheet()->setCellValue('B' . $no, $data->full_nomor);
      $spreadsheet->getActiveSheet()->setCellValue('C' . $no, $data->perihal);
      $spreadsheet->getActiveSheet()->setCellValue('D' . $no, $data->date);
      $spreadsheet->getActiveSheet()->setCellValue('E' . $no, $data->tujuan);
      $no++;
    }

    $spreadsheet->getActiveSheet()->getStyle('A7:E' . ($no - 1))->applyFromArray($this->lineIsiTabel);
    $spreadsheet->getActiveSheet()->getStyle('A7:B' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('D7:D' . $no)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A7:E' . ($no - 1))->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
    $spreadsheet->getActiveSheet()->getStyle('C7:C' . ($no - 1))->getAlignment()->setWrapText(true);

    $spreadsheet->getActiveSheet()->mergeCells('A' . $no . ':E' . $no);
    $spreadsheet->getActiveSheet()->setCellValue('A' . $no, 'JUMLAH SURAT KELUAR : ' . count($datas));

    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':E' . $no)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('C9C9C9');
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':E' . $no)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':E' . $no)->getFont()->setItalic(true);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':E' . $no)->applyFromArray($this->lineJumlah);
    $spreadsheet->getActiveSheet()->getStyle('A' . $no . ':E' . $no)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

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
