<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_pelaporan_detail', function (Blueprint $table) {
            $table->id('iddetail');
            $table->unsignedBigInteger('t_pelaporan_idpelaporan');
            $table->unsignedBigInteger('m_fasum_idfasum');
            $table->text('status_perbaikkan')->comment("'Sedang dikerjakan'");
            $table->text('foto_fasum')->nullable();
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('idstaff')->nullable();

            $table->foreign('t_pelaporan_idpelaporan')->references('idpelaporan')->on('t_pelaporan');
            $table->foreign('m_fasum_idfasum')->references('idfasum')->on('m_fasum');
            $table->foreign('idstaff')->references('idm_staff')->on('m_staff');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_pelaporan_detail');
    }
};
