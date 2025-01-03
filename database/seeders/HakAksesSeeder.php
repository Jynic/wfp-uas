<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HakAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('a_hak_akses')->insert([
            ['idhak_akses' => 1, 'kode_fitur' => 'm_provinsi', 'nama_fitur' => 'master_provinsi', 'status_aktif' => 1],
            ['idhak_akses' => 2, 'kode_fitur' => 'm_kota_kabupaten', 'nama_fitur' => 'master_kota', 'status_aktif' => 1],
            ['idhak_akses' => 3, 'kode_fitur' => 'm_dinas', 'nama_fitur' => 'master_dinas', 'status_aktif' => 1],
            ['idhak_akses' => 4, 'kode_fitur' => 'm_jenis_fasum', 'nama_fitur' => 'master_jenis_fasilitas_umum', 'status_aktif' => 1],
            ['idhak_akses' => 5, 'kode_fitur' => 'm_staff', 'nama_fitur' => 'master_staff', 'status_aktif' => 1],
            ['idhak_akses' => 6, 'kode_fitur' => 'm_user', 'nama_fitur' => 'master_user', 'status_aktif' => 1],
            ['idhak_akses' => 7, 'kode_fitur' => 't_pelaporan', 'nama_fitur' => 'transaksi_pelaporan', 'status_aktif' => 1],
            ['idhak_akses' => 8, 'kode_fitur' => 't_pelaporan_admin', 'nama_fitur' => 'transaksi_pelaporan_admin', 'status_aktif' => 1],
            ['idhak_akses' => 9, 'kode_fitur' => 'r_histori_perbaikkan', 'nama_fitur' => 'report_history_perbaikkan', 'status_aktif' => 1],
            ['idhak_akses' => 10, 'kode_fitur' => 'm_fasum', 'nama_fitur' => 'master_fasum', 'status_aktif' => 1],
            ['idhak_akses' => 11, 'kode_fitur' => 'a_hak_akses', 'nama_fitur' => 'hak_akses', 'status_aktif' => 1],
        ]);
    }
}
