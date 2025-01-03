<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisFasumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_jenis_fasum')->insert([
            ['idjenis_fasum' => 1, 'nama' => 'Rumah Sakit', 'status_aktif' => 1],
            ['idjenis_fasum' => 2, 'nama' => 'Poliklinik', 'status_aktif' => 1],
            ['idjenis_fasum' => 3, 'nama' => 'Jalan Raya', 'status_aktif' => 1],
        ]);
    }
}
