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
        Schema::create('tlncr', function (Blueprint $table) {
            $table->id('id_formncrtl');
            $table->integer('id_ncr');
            $table->string('akar_masalah', 200)->nullable();
            $table->string('uraian_perbaikan', 200)->nullable();
            $table->string('uraian_pencegahan', 200)->nullable();
            $table->date('tgl_action')->nullable();
            $table->date('tgl_accgm')->nullable();
            $table->string('uraian_verifikasi', 200)->nullable();
            $table->string('hasil_verif', 15)->nullable();
            $table->string('verifikator', 100)->nullable();
            $table->date('tgl_verif')->nullable();
            $table->string('rekomendasi', 200)->nullable();
            $table->string('namasm_verif', 200)->nullable();
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
        Schema::dropIfExists('tlncr');
    }
};
