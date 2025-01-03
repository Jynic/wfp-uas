<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_kategori_fasum_has_m_fasum', function (Blueprint $table) {
            $table->unsignedBigInteger('m_kategori_fasum_idkategori_fasum');
            $table->unsignedBigInteger('m_fasum_idfasum');

            $table->primary(['m_kategori_fasum_idkategori_fasum', 'm_fasum_idfasum']);

            $table->foreign('m_kategori_fasum_idkategori_fasum', 'fk_kategori_fasum')
                ->references('idkategori_fasum')
                ->on('m_kategori_fasum');

            $table->foreign('m_fasum_idfasum', 'fk_fasum')
                ->references('idfasum')
                ->on('m_fasum');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_kategori_fasum_has_m_fasum');
    }
};
