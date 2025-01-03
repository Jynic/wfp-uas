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
            ['iddinas' => 2, 'idkota_kabupaten' => 1, 'nama' => 'Dinas Panjang Jiwo', 'alamat' => 'Jalan Panjang Jiwo Senyawa Surya No 31', 'status_aktif' => 0],
        ]);
    }
}
