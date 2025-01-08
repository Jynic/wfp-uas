<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_pelaporan')->insert([
            [
                'idpelaporan' => 1,
                'nomor' => 'P/2501/0001',
                'tgl_pelaporan' => '2025-01-08 14:55:58',
                'iduser' => 2,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'Test',
                'status_aktif' => 1
            ],
        ]);
    }
}
