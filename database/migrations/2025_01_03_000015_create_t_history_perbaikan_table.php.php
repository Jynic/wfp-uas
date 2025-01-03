<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_history_perbaikan', function (Blueprint $table) {
            $table->id('idhistory_perbaikan');
            $table->unsignedBigInteger('idpelaporan');
            $table->datetime('tgl')->nullable();
            $table->text('keterangan')->nullable();

            $table->foreign('idpelaporan')->references('idpelaporan')->on('t_pelaporan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_history_perbaikan');
    }
};
