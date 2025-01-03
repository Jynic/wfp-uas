<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_staff')->insert([
            [
                'idm_staff' => 6,
                'iddinas' => 1,
                'idjabatan' => 3,
                'nama' => 'ivano',
                'username' => 'ivano',
                'password' => '$2y$10$JT.QibcHCKwjWz27UE3ND.we8ROIu9RN.Pnu4czb8ghb/zJRIbs3m',
                'status_aktif' => 1,
                'alamat' => null,
                'email' => null,
                'idkota_kabupaten' => 1
            ],
            [
                'idm_staff' => 8,
                'iddinas' => 1,
                'idjabatan' => 1,
                'nama' => 'Belum Pilih',
                'username' => 'budi_123',
                'password' => '$2y$10$pSIPIrwS5tOWOLw7k2kfr.SZDXASolziTxj/ez7JjTkJi2V3cBBsS',
                'status_aktif' => 0,
                'alamat' => null,
                'email' => null,
                'idkota_kabupaten' => null
            ],
            [
                'idm_staff' => 9,
                'iddinas' => 1,
                'idjabatan' => 1,
                'nama' => 'Bagus',
                'username' => 'bagus',
                'password' => '$2y$10$pZuyqHXtE0DAtTQJSyhdnu6Gaic5pS9lm.nuFzYWX.GF5trabho.2',
                'status_aktif' => 1,
                'alamat' => null,
                'email' => null,
                'idkota_kabupaten' => null
            ],
            [
                'idm_staff' => 10,
                'iddinas' => 1,
                'idjabatan' => 2,
                'nama' => 'ridwan',
                'username' => 'ridwan',
                'password' => '$2y$10$HCfDkmO9ZQ0HHC.gDTMwIeX0GrV0ritNdwXf/nQEWY1k/oKRg2dCS',
                'status_aktif' => 1,
                'alamat' => 'Jalan Rungkut No 31',
                'email' => 'ridwan@gmail.com',
                'idkota_kabupaten' => 1
            ],
            [
                'idm_staff' => 11,
                'iddinas' => 1,
                'idjabatan' => 2,
                'nama' => 'ramli',
                'username' => 'ramli',
                'password' => '$2y$10$JT.QibcHCKwjWz27UE3ND.we8ROIu9RN.Pnu4czb8ghb/zJRIbs3m',
                'status_aktif' => 1,
                'alamat' => 'Jalan Rungkut No 31',
                'email' => 'ramli@gmail.com',
                'idkota_kabupaten' => 1
            ]
        ]);
    }
}
