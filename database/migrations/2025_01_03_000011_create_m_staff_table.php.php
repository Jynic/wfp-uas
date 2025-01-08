<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_staff', function (Blueprint $table) {
            $table->id('idm_staff');
            $table->unsignedBigInteger('iddinas')->nullable();
            $table->unsignedBigInteger('idjabatan');
            $table->text('nama');
            $table->text('username');
            $table->integer('status_aktif')->default(1);
            $table->text('alamat');
            $table->text('email');

            $table->foreign('iddinas')->references('iddinas')->on('m_dinas');
            $table->foreign('idjabatan')->references('idjabatan')->on('m_jabatan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_staff');
    }
};
