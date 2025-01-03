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
                'nomor' => 'P/2412/0001',
                'tgl_pelaporan' => '2024-12-20 14:55:58',
                'idm_staff' => 6,
                'iduser' => 3,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'Test',
                'status_aktif' => 1
            ],
            [
                'idpelaporan' => 3,
                'nomor' => 'P/2412/0002',
                'tgl_pelaporan' => '2024-12-24 13:26:45',
                'idm_staff' => 6,
                'iduser' => 2,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'tesy',
                'status_aktif' => 1
            ],
            [
                'idpelaporan' => 4,
                'nomor' => 'P/2412/0002',
                'tgl_pelaporan' => '2024-12-24 13:28:30',
                'idm_staff' => 6,
                'iduser' => 2,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'test',
                'status_aktif' => 1
            ],
            [
                'idpelaporan' => 5,
                'nomor' => 'P/2412/0004',
                'tgl_pelaporan' => '2024-12-24 13:28:30',
                'idm_staff' => 9,
                'iduser' => 3,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'test hapus',
                'status_aktif' => 0
            ],
            [
                'idpelaporan' => 6,
                'nomor' => 'P/2412/0005',
                'tgl_pelaporan' => '2024-12-24 14:07:11',
                'idm_staff' => 9,
                'iduser' => 2,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'ttt6',
                'status_aktif' => 1
            ],
            [
                'idpelaporan' => 7,
                'nomor' => 'P/2412/0006',
                'tgl_pelaporan' => '2024-12-24 14:10:26',
                'idm_staff' => 6,
                'iduser' => 2,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'tes',
                'status_aktif' => 1
            ],
            [
                'idpelaporan' => 8,
                'nomor' => 'P/2412/0007',
                'tgl_pelaporan' => '2024-12-24 14:41:58',
                'idm_staff' => 6,
                'iduser' => 2,
                'status_pelaporan' => 'Antri',
                'keterangan' => 'te',
                'status_aktif' => 1
            ],
            [
                'idpelaporan' => 9,
                'nomor' => 'P/2412/0008',
                'tgl_pelaporan' => '2024-12-26 13:23:16',
                'idm_staff' => 8,
                'iduser' => 3,
                'status_pelaporan' => 'Selesai',
                'keterangan' => 'hahaha',
                'status_aktif' => 1
            ]
        ]);
    }
}
