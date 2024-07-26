<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entry', function (Blueprint $table) {
            $table->id();
            $table->string('id_kantor');
            $table->string('nama_kantor');
            $table->string('jenis_kantor');
            $table->string('pso_non_pso');
            $table->string('kcu_kc');
            $table->string('nomor_nde');
            $table->date('tanggal_nde');
            $table->string('perihal');
            $table->string('pejabat_pengirim_nde');
            $table->string('regional');
            $table->string('jenis_pengajuan');
            $table->string('biaya_yang_diajukan');
            $table->string('masa_sewa');
            $table->date('tmt');
            $table->date('sd');

            // Fields for kinerja 2021, 2022, 2023
            $table->text('kinerja_2021');
            $table->text('kinerja_2022');
            $table->text('kinerja_2023');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry');
    }
};
