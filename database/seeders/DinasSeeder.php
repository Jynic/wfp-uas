<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('m_dinas')->insert([
            ['iddinas' => 1, 'idkota_kabupaten' => 1, 'nama' => 'Dinas Rungkut', 'alamat' => 'Jalan Singosari Raya Bawah Dusun No 31', 'status_aktif' => 1],
            ['iddinas' => 2, 'idkota_kabupaten' => 1, 'nama' => 'Dinas Panjang Jiwo', 'alamat' => 'Jalan Panjang Jiwo Senyawa Surya No 31', 'status_aktif' => 1],
            ['iddinas' => 3, 'idkota_kabupaten' => 4, 'nama' => 'Dinas Sidoarjo', 'alamat' => 'Jalan Sidoarjo', 'status_aktif' => 1],
            ['iddinas' => 4, 'idkota_kabupaten' => 5, 'nama' => 'Dinas Malang', 'alamat' => 'Jalan Malang', 'status_aktif' => 1],
            ['iddinas' => 5, 'idkota_kabupaten' => 7, 'nama' => 'Dinas Bandung', 'alamat' => 'Jalan Bandung', 'status_aktif' => 1],
            ['iddinas' => 6, 'idkota_kabupaten' => 10, 'nama' => 'Dinas Salatiga', 'alamat' => 'Jalan Salatiga', 'status_aktif' => 1],
            ['iddinas' => 7, 'idkota_kabupaten' => 4, 'nama' => 'Dinas Sidoarjo Baru', 'alamat' => 'Jalan Sidoarjo Baru', 'status_aktif' => 1],
            ['iddinas' => 8, 'idkota_kabupaten' => 5, 'nama' => 'Dinas Malang Baru', 'alamat' => 'Jalan Malang Baru', 'status_aktif' => 1],
            ['iddinas' => 9, 'idkota_kabupaten' => 7, 'nama' => 'Dinas Bandung Baru', 'alamat' => 'Jalan Bandung Baru', 'status_aktif' => 1],
            ['iddinas' => 10, 'idkota_kabupaten' => 10, 'nama' => 'Dinas Salatiga Baru', 'alamat' => 'Jalan Salatiga Baru', 'status_aktif' => 1]
        ]);
    }
}
