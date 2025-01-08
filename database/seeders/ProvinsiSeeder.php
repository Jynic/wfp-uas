<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_provinsi')->insert([
            [
                'idprovinsi' => 1,
                'kode' => "JTM",
                'nama' => "Jawa Timur",
                'status_aktif' => 1,
            ],
            [
                'idprovinsi' => 2,
                'kode' => "JK",
                'nama' => "DKI Jakarta",
                'status_aktif' => 1,
            ],
            [
                'idprovinsi' => 3,
                'kode' => "JBR",
                'nama' => "Jawa Barat",
                'status_aktif' => 1,
            ],
            [
                'idprovinsi' => 4,
                'kode' => "JTG",
                'nama' => "Jawa Tengah",
                'status_aktif' => 1,
            ],
            [
                'idprovinsi' => 5,
                'kode' => "YOG",
                'nama' => "Daerah Istimewa Yogyakarta",
                'status_aktif' => 1,
            ],
            [
                'idprovinsi' => 6,
                'kode' => "BNT",
                'nama' => "Banten",
                'status_aktif' => 1,
            ],
            [
                'idprovinsi' => 7,
                'kode' => "BAL",
                'nama' => "Bali",
                'status_aktif' => 1,
            ],
        ]);
    }
}
