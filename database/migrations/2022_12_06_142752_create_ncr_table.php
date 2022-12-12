<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('ncr', function (Blueprint $table) {
            $table->id('id_ncr');
            $table->string('no_ncr', 20)->nullable();
            $table->string('proses_audit', 10)->nullable();
            $table->string('tema_audit', 10)->nullable();
            $table->string('objek_audit', 50)->nullable();
            $table->string('jenis_temuan', 25)->nullable();
            $table->string('dokumen', 5)->nullable();
            $table->date('tgl_terbitncr')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('bukti', 200)->nullable();
            $table->string('bab_audit', 100)->nullable();
            $table->string('dok_acuan', 100)->nullable();
            $table->string('uraian_ncr', 200)->nullable();
            $table->string('kategori', 5)->nullable();
            $table->string('nama_auditor', 100)->nullable();
            $table->date('tgl_deadline')->nullable();
            $table->string('diakui_oleh', 100)->nullable();
            $table->string('disetujui_oleh', 50)->nullable();
            $table->date('tgl_accgm')->nullable();
            $table->date('tgl_planaction')->nullable();
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
        Schema::dropIfExists('ncr');
    }
};
