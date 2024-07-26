<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $table = 'entry';

    protected $fillable = [
        'nama_kantor',
        'id_kantor',
        'jenis_kantor',
        'pso_non_pso',
        'regional',
        'kcu_kc',
        'nomor_nde',
        'tanggal_nde',
        'perihal',
        'pejabat_pengirim_nde',
        'jenis_pengajuan',
        'biaya_yang_diajukan',
        'masa_sewa',
        'tmt',
        'sd',
        'kinerja_2021',
        'kinerja_2022',
        'kinerja_2023',
        'kinerja_2021_kurlog',
        'kinerja_2021_jaskug',
        'kinerja_2021_ritel',
        'kinerja_2021_biaya',
        'kinerja_2022_kurlog',
        'kinerja_2022_jaskug',
        'kinerja_2022_ritel',
        'kinerja_2022_biaya',
        'kinerja_2023_kurlog',
        'kinerja_2023_jaskug',
        'kinerja_2023_ritel',
        'kinerja_2023_biaya',
    ];
}
