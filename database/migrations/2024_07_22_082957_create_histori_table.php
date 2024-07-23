<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori', function (Blueprint $table) {
            $table->id();
            $table->string('id_kantor');
            $table->string('nama_kantor');
            $table->string('jenis_kantor');
            $table->string('pso_non_pso');
            $table->string('kcu_kc');
            $table->string('nomor_nde');
            $table->date('tanggal_nde');
            $table->string('pejabat_pengirim_nde');
            $table->string('regional');
            $table->string('jenis_pengajuan');
            $table->string('biaya_yang_diajukan');
            $table->string('masa_sewa');
            $table->date('tmt');
            $table->date('sd');
            $table->string('kinerja_2021', 5, 2)->nullable();
            $table->string('kinerja_2022', 5, 2)->nullable();
            $table->string('kinerja_2023', 5, 2)->nullable();
            $table->date('tanggal_submit_surat');
            $table->string('perihal');
            $table->string('keterangan')->nullable();
            $table->string('status');
            $table->date('tanggal_edit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histori');
    }
};
