<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'izin_operasi';

    // Tambahkan atribut yang diizinkan untuk diisi
    protected $fillable = [
        'id_kantor', 'nama_kantor', 'jenis_kantor', 'pso_non_pso', 'kcu_kc', 'nomor_nde',
        'tanggal_nde', 'perihal', 'pejabat_pengirim_nde', 'regional', 'jenis_pengajuan',
        'biaya_yang_diajukan', 'masa_sewa', 'tmt', 'sd', 'kinerja_2021', 'kinerja_2022', 'kinerja_2023',
        'tanggal_edit', 'keterangan', 'status', 'tanggal_submit_surat'
    ];
}