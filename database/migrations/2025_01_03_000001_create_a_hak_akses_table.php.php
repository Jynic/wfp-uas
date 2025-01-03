<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('a_hak_akses', function (Blueprint $table) {
            $table->id('idhak_akses');
            $table->text('kode_fitur')->nullable();
            $table->text('nama_fitur')->nullable();
            $table->integer('status_aktif')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('a_hak_akses');
    }
};
