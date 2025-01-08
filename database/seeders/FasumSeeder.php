<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('m_fasum')->insert([
            ['idfasum' => 1, 'm_dinas_iddinas' => 1, 'nama' => 'Tiang Listrik', 'luas_fasum' => 4, 'kondisi_fasum' => 'Baik', 'asal_fasum' => 'Swasta', 'lat' => '-7.3150508016307905', 'lng' => '112.76669740676881', 'gambar' => '-', 'status_aktif' => 1],
            ['idfasum' => 2, 'm_dinas_iddinas' => 1, 'nama' => '', 'luas_fasum' => 421, 'kondisi_fasum' => 'Baik', 'asal_fasum' => 'Swasta', 'lat' => '-7.3150508016307905', 'lng' => '112.76669740676881', 'gambar' => '-', 'status_aktif' => 1],
            ['idfasum' => 3, 'm_dinas_iddinas' => 1, 'nama' => 'Halte A', 'luas_fasum' => 421, 'kondisi_fasum' => 'Baik', 'asal_fasum' => 'Swasta', 'lat' => '-7.3150508016307905', 'lng' => '112.76729822158815', 'gambar' => '-', 'status_aktif' => 1],
        ]);
    }
}
