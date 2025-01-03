<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotaKabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_kota_kabupaten')->insert([
            ['idkota_kabupaten' => 1, 'kode' => 'Sby', 'nama' => 'Kota Surabaya', 'jenis' => 'kota', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 1],
            ['idkota_kabupaten' => 2, 'kode' => 'Gto', 'nama' => 'Gorontalo', 'jenis' => 'kota', 'status_aktif' => 0, 'm_provinsi_idprovinsi' => 1],
            ['idkota_kabupaten' => 3, 'kode' => 'PRE', 'nama' => 'Pare', 'jenis' => 'kabupaten', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 1],
        ]);
    }
}
