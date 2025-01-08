<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriFasumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_kategori_fasum')->insert([
            ['idkategori_fasum' => 1, 'nama' => 'Trotoar', 'status_aktif' => 1],
            ['idkategori_fasum' => 2, 'nama' => 'Rumah Sakit', 'status_aktif' => 1],
            ['idkategori_fasum' => 3, 'nama' => 'Jalan Tol', 'status_aktif' => 1],
            ['idkategori_fasum' => 4, 'nama' => 'Bangunan Serbaguna', 'status_aktif' => 1],
        ]);
    }
}
