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
        Schema::table('tlncr', function (Blueprint $table) {
            $table->string('disetujui_oleh', 50)->nullable()->after('tgl_action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tlncr', function (Blueprint $table) {
            $table->dropColumn('disetujui_oleh');
        });
    }
};
