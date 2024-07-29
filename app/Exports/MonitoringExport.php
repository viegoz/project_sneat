<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Illuminate\Http\Response;
use App\Models\Entry;

class MonitoringExport
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function export($format = 'xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headings
        $headings = [
            'Nama Kantor', 'Jenis Kantor', 'PSO/Non-PSO', 'KCU/KC', 'Nomor NDE', 'Tanggal NDE',
            'Perihal', 'Pejabat Pengirim NDE', 'Regional', 'Jenis Pengajuan', 'Biaya yang Diajukan',
            'Masa Sewa', 'TMT', 'SD', 'Kinerja 2021', 'Kinerja 2022', 'Kinerja 2023',
            'Status', 'Keterangan', 'Tanggal Edit', 'Tanggal Submit Surat'
        ];
        $sheet->fromArray($headings, null, 'A1');

        // Set data
        $row = 2;
        foreach ($this->data as $item) {
            $sheet->fromArray([
                $item->nama_kantor, $item->jenis_kantor, $item->pso_non_pso, $item->kcu_kc, $item->nomor_nde,
                $item->tanggal_nde, $item->perihal, $item->pejabat_pengirim_nde, $item->regional, $item->jenis_pengajuan,
                $item->biaya_yang_diajukan, $item->masa_sewa, $item->tmt, $item->sd, $item->kinerja_2021,
                $item->kinerja_2022, $item->kinerja_2023, $item->status, $item->keterangan,
                $item->tanggal_edit, $item->tanggal_submit_surat
            ], null, 'A' . $row++);
        }

        // Write to file
        if ($format === 'xlsx') {
            $writer = new Xlsx($spreadsheet);
            $fileName = 'monitoring.xlsx';
        } else {
            $writer = new Csv($spreadsheet);
            $fileName = 'monitoring.csv';
        }

        $filePath = storage_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
