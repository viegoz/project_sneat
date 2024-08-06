<?php

namespace App\Exports;

use App\Models\Entry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MonitoringExport implements FromCollection, WithHeadings
{
    protected $month;
    protected $year;
    protected $regional;
    protected $status;

    public function __construct($month, $year, $regional, $status)
    {
        $this->month = $month;
        $this->year = $year;
        $this->regional = $regional;
        $this->status = $status;
    }

    public function collection()
    {
        $query = Entry::query();

        if ($this->month) {
            $query->whereMonth('tmt', $this->month);
        }
        if ($this->year) {
            $query->whereYear('tmt', $this->year);
        }
        if ($this->regional) {
            $query->where('regional', 'like', '%' . $this->regional . '%');
        }
        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nama Kantor',
            'Jenis Kantor',
            'PSO/Non-PSO',
            'KCU/KC',
            'Nomor NDE',
            'Tanggal NDE',
            'Perihal',
            'Pejabat Pengirim NDE',
            'Regional',
            'Jenis Pengajuan',
            'Biaya yang Diajukan',
            'Masa Sewa',
            'TMT',
            'SD',
            'Kinerja 2021',
            'Kinerja 2022',
            'Kinerja 2023',
            'Status',
            'Keterangan',
            'Tanggal Edit',
            'Tanggal Submit Surat',
        ];
    }
    
}