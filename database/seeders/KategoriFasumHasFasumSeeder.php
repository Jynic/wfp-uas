<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriFasumHasFasumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_kategori_fasum_has_m_fasum')->insert([
            ['m_kategori_fasum_idkategori_fasum' => 1, 'm_fasum_idfasum' => 1],
            ['m_kategori_fasum_idkategori_fasum' => 4, 'm_fasum_idfasum' => 1],
            ['m_kategori_fasum_idkategori_fasum' => 4, 'm_fasum_idfasum' => 23],
            ['m_kategori_fasum_idkategori_fasum' => 5, 'm_fasum_idfasum' => 23],
            ['m_kategori_fasum_idkategori_fasum' => 5, 'm_fasum_idfasum' => 24],
        ]);
    }
}
