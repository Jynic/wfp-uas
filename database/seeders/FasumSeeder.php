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
            ['idfasum' => 2, 'm_dinas_iddinas' => 1, 'nama' => 'Fasum A', 'luas_fasum' => 421, 'kondisi_fasum' => 'Baik', 'asal_fasum' => 'Swasta', 'lat' => '-7.3150508016307905', 'lng' => '112.76669740676881', 'gambar' => '-', 'status_aktif' => 1],
            ['idfasum' => 3, 'm_dinas_iddinas' => 1, 'nama' => 'Halte A', 'luas_fasum' => 421, 'kondisi_fasum' => 'Baik', 'asal_fasum' => 'Swasta', 'lat' => '-7.3150508016307905', 'lng' => '112.76729822158815', 'gambar' => '-', 'status_aktif' => 1],
            ['idfasum' => 4, 'm_dinas_iddinas' => 2, 'nama' => 'Rumah Sakit Lorem ipsum', 'luas_fasum' => 2000, 'kondisi_fasum' => 'Baik', 'asal_fasum' => 'APBN', 'lat' => '-7.3150508016307905', 'lng' => '112.76729822158815', 'gambar' => '-', 'status_aktif' => 1],
            ['idfasum' => 5, 'm_dinas_iddinas' => 1, 'nama' => 'Rumah Sakit Diabetes', 'luas_fasum' => 200, 'kondisi_fasum' => 'Rusak', 'asal_fasum' => 'APBD', 'lat' => '-7.3150508016307905', 'lng' => '112.76729822158815', 'gambar' => '-', 'status_aktif' => 1],
            ['idfasum' => 6, 'm_dinas_iddinas' => 2, 'nama' => 'Rumah Sakit Wibu', 'luas_fasum' => 500, 'kondisi_fasum' => 'Baik', 'asal_fasum' => 'Swasta', 'lat' => '-7.3150508016307905', 'lng' => '112.76729822158815', 'gambar' => '-', 'status_aktif' => 1],
            ['idfasum' => 7, 'm_dinas_iddinas' => 2, 'nama' => 'Jalan Tol Letprol', 'luas_fasum' => 2000, 'kondisi_fasum' => 'Baik', 'asal_fasum' => 'APBN', 'lat' => '-7.3150508016307905', 'lng' => '112.76729822158815', 'gambar' => '-', 'status_aktif' => 1],
            ['idfasum' => 8, 'm_dinas_iddinas' => 1, 'nama' => 'Jalan Tol Pondok Candra', 'luas_fasum' => 5000, 'kondisi_fasum' => 'Rusak', 'asal_fasum' => 'APBD', 'lat' => '-7.3150508016307905', 'lng' => '112.76729822158815', 'gambar' => '-', 'status_aktif' => 1],
            ['idfasum' => 9, 'm_dinas_iddinas' => 1, 'nama' => 'Kantor Pos Rungkut', 'luas_fasum' => 250, 'kondisi_fasum' => 'Rusak', 'asal_fasum' => 'APBD', 'lat' => '-7.3150508016307905', 'lng' => '112.76729822158815', 'gambar' => '-', 'status_aktif' => 1],
            ['idfasum' => 10, 'm_dinas_iddinas' => 2, 'nama' => 'Halte Bus', 'luas_fasum' => 250, 'kondisi_fasum' => 'Baik', 'asal_fasum' => 'APBN', 'lat' => '-7.3150508016307905', 'lng' => '112.76729822158815', 'gambar' => '-', 'status_aktif' => 1],
        ]);
    }
}
