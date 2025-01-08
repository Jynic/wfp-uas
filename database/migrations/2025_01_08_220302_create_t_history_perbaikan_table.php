<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_history_perbaikan', function (Blueprint $table) {
            $table->id('idhistory');
            $table->timestamp('tgl_perubahan');
            $table->unsignedBigInteger('idpelaporan');
            $table->unsignedBigInteger('idstaff')->nullable();
            $table->enum('status_sebelumnya', ['Antri', 'Dikerjakan', 'Outsource', 'Selesai', 'Tidak Terselesaikan']);
            $table->enum('status_setelahnya', ['Antri', 'Dikerjakan', 'Outsource', 'Selesai', 'Tidak Terselesaikan']);
            $table->text('keterangan')->nullable();

            $table->foreign('idpelaporan')->references('idpelaporan')->on('t_pelaporan');
            $table->foreign('idstaff')->references('idm_staff')->on('m_staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_history_perbaikan');
    }
};
