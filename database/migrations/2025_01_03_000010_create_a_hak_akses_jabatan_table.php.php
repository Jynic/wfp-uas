<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('a_hak_akses_jabatan', function (Blueprint $table) {
            $table->unsignedBigInteger('idhak_akses');
            $table->unsignedBigInteger('idjabatan');

            $table->primary(['idhak_akses', 'idjabatan']);
            $table->foreign('idhak_akses')->references('idhak_akses')->on('a_hak_akses');
            $table->foreign('idjabatan')->references('idjabatan')->on('m_jabatan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('a_hak_akses_jabatan');
    }
};
