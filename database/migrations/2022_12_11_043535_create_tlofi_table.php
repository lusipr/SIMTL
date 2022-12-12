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
        Schema::create('tlofi', function (Blueprint $table) {
            $table->id('id_formofitl');
            $table->string('id_ofi', 15)->nullable();
            $table->string('tl_usulanofi', 500)->nullable();
            $table->string('nama_pekerjatl', 100)->nullable();
            $table->date('tgl_tl')->nullable();
            $table->string('uraian_verif', 500)->nullable();
            $table->string('hasil_verif', 500)->nullable();
            $table->string('nama_verifikator', 100)->nullable();
            $table->date('tgl_verif')->nullable();
            $table->string('eval_saran', 500)->nullable();
            $table->string('nama_evaluator', 100)->nullable();
            $table->string('skor', 5)->nullable();
            $table->string('rekom_tinjauan', 500)->nullable();
            $table->string('namasm_verifikator', 100)->nullable();
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
        Schema::dropIfExists('tlofi');
    }
};
