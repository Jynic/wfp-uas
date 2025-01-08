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
                'iduser' => 4,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'Fasum banyak yang rusak',
                'status_aktif' => 1
            ],
            [
                'idpelaporan' => 2,
                'nomor' => 'P/2412/0002',
                'tgl_pelaporan' => '2024-12-28 14:55:58',
                'iduser' => 4,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'Fasum kotor sekali',
                'status_aktif' => 1
            ],
            [
                'idpelaporan' => 3,
                'nomor' => 'P/2412/0003',
                'tgl_pelaporan' => '2024-12-10 14:55:58',
                'iduser' => 5,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'Fasum ini masih oke',
                'status_aktif' => 1
            ],
            [
                'idpelaporan' => 4,
                'nomor' => 'P/2501/0004',
                'tgl_pelaporan' => '2025-01-05 14:55:58',
                'iduser' => 4,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'Fasum ini tidak bisa digunakan',
                'status_aktif' => 1
            ],
        ]);
    }
}
