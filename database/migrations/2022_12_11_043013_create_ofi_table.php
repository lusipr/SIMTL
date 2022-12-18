<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofi', function (Blueprint $table) {
            $table->id('id_ofi');
            $table->string('no_ofi', 20)->nullable();
            $table->string('proses_audit', 10)->nullable();
            $table->string('tema_audit', 10)->nullable();
            $table->string('objek_audit', 50)->nullable();
            $table->string('jenis_temuan', 25)->nullable();
            $table->string('dokumen', 5)->nullable();
            $table->date('tgl_terbitofi')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('bukti', 200)->nullable();
            $table->string('asal_dept', 100)->nullable();
            $table->string('proyek', 50)->nullable();
            $table->string('dept_ygmngrjkn', 100)->nullable();
            $table->string('usulan_ofi', 200)->nullable();
            $table->string('uraian_permasalahan', 200)->nullable();
            $table->string('usulan_peningkatan', 200)->nullable();
            $table->string('dept_pengusul', 100)->nullable();
            $table->date('tgl_diusulkan')->nullable();
            $table->string('disetujui_oleh', 100)->nullable();
            $table->date('tgl_disetujui')->nullable();
            $table->string('disposisi', 100)->nullable();
            $table->string('disposisi_diselesaikan_oleh', 100)->nullable();
            $table->date('tgl_deadline')->nullable();
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
        Schema::dropIfExists('ofi');
    }
};
