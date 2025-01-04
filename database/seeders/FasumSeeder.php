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
            ['idfasum' => 1, 'm_dinas_iddinas' => 1, 'nama' => 'Tiang Listrik', 'luas_fasum' => 4, 'kondisi_fasum' => 'Bengkok & penyok', 'asal_fasum' => 'Swasta', 'lat' => '-7.3150508016307905', 'lng' => '112.76669740676881', 'gambar' => '-', 'status_aktif' => 0],
            ['idfasum' => 2, 'm_dinas_iddinas' => 1, 'nama' => '', 'luas_fasum' => 421, 'kondisi_fasum' => 'tess', 'asal_fasum' => 'Swasta', 'lat' => '-7.3150508016307905', 'lng' => '112.76669740676881', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 3, 'm_dinas_iddinas' => 1, 'nama' => 'Halte A', 'luas_fasum' => 421, 'kondisi_fasum' => 'test', 'asal_fasum' => 'Swasta', 'lat' => '-7.3150508016307905', 'lng' => '112.76729822158815', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 4, 'm_dinas_iddinas' => 1, 'nama' => 'Halte B', 'luas_fasum' => 421, 'kondisi_fasum' => 'test', 'asal_fasum' => 'Swasta', 'lat' => '-7.3125459', 'lng' => '112.7740438', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 5, 'm_dinas_iddinas' => 1, 'nama' => 'Halte C', 'luas_fasum' => 422, 'kondisi_fasum' => 'test', 'asal_fasum' => 'Swasta', 'lat' => '-7.315263631867809', 'lng' => '112.76674032211305', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 6, 'm_dinas_iddinas' => 1, 'nama' => '', 'luas_fasum' => 422, 'kondisi_fasum' => '5ttttt', 'asal_fasum' => 'Swasta', 'lat' => '-7.3125459', 'lng' => '112.7740438', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 7, 'm_dinas_iddinas' => 1, 'nama' => 'Halte D', 'luas_fasum' => 43, 'kondisi_fasum' => '5555', 'asal_fasum' => 'Swasta', 'lat' => '-7.315093367686321', 'lng' => '112.76676177978517', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 8, 'm_dinas_iddinas' => 1, 'nama' => 'DhALTE e', 'luas_fasum' => 43, 'kondisi_fasum' => '5555', 'asal_fasum' => 'Swasta', 'lat' => '-7.315178499785182', 'lng' => '112.7665686607361', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 9, 'm_dinas_iddinas' => 1, 'nama' => 'Stasiun A', 'luas_fasum' => 433, 'kondisi_fasum' => 'ttttt', 'asal_fasum' => 'APBN', 'lat' => '-7.316881138352193', 'lng' => '112.76652574539185', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 10, 'm_dinas_iddinas' => 1, 'nama' => 'Stasiun B', 'luas_fasum' => 444, 'kondisi_fasum' => 'ttttt', 'asal_fasum' => 'Swasta', 'lat' => '-7.316583177071914', 'lng' => '112.76716947555543', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 11, 'm_dinas_iddinas' => 1, 'nama' => 'Stasiun', 'luas_fasum' => 455, 'kondisi_fasum' => 'ttt', 'asal_fasum' => 'Swasta', 'lat' => '-7.316370347464187', 'lng' => '112.76723384857178', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 12, 'm_dinas_iddinas' => 1, 'nama' => 'Stasiun C', 'luas_fasum' => 333, 'kondisi_fasum' => 'tttt', 'asal_fasum' => 'Swasta', 'lat' => '-7.316881138352193', 'lng' => '112.76678323745729', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 13, 'm_dinas_iddinas' => 1, 'nama' => '', 'luas_fasum' => 0, 'kondisi_fasum' => '', 'asal_fasum' => '', 'lat' => '', 'lng' => '', 'gambar' => 'img_fasum/13_.jpg', 'status_aktif' => 0],
            ['idfasum' => 14, 'm_dinas_iddinas' => 1, 'nama' => '', 'luas_fasum' => 0, 'kondisi_fasum' => '', 'asal_fasum' => '', 'lat' => '', 'lng' => '', 'gambar' => 'img_fasum/14_.jpg', 'status_aktif' => 0],
            ['idfasum' => 15, 'm_dinas_iddinas' => 1, 'nama' => 'Rumah Kucinta', 'luas_fasum' => 345345, 'kondisi_fasum' => 'tgegregergerge', 'asal_fasum' => 'APBN', 'lat' => '-7.325096278114431', 'lng' => '112.78459310531618', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 16, 'm_dinas_iddinas' => 1, 'nama' => 'Ruamh Kucinta 32', 'luas_fasum' => 333, 'kondisi_fasum' => 'fwrgwgrew', 'asal_fasum' => 'Swasta', 'lat' => '-7.325521928899939', 'lng' => '112.78369188308717', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 17, 'm_dinas_iddinas' => 1, 'nama' => '', 'luas_fasum' => 0, 'kondisi_fasum' => '', 'asal_fasum' => '', 'lat' => '', 'lng' => '', 'gambar' => 'img_fasum/17_.png', 'status_aktif' => 0],
            ['idfasum' => 18, 'm_dinas_iddinas' => 1, 'nama' => '', 'luas_fasum' => 0, 'kondisi_fasum' => '', 'asal_fasum' => '', 'lat' => '', 'lng' => '', 'gambar' => 'img_fasum/18_.png', 'status_aktif' => 0],
            ['idfasum' => 19, 'm_dinas_iddinas' => 1, 'nama' => '', 'luas_fasum' => 0, 'kondisi_fasum' => '', 'asal_fasum' => '', 'lat' => '', 'lng' => '', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 20, 'm_dinas_iddinas' => 1, 'nama' => 'Ivano Zefanya', 'luas_fasum' => 597348, 'kondisi_fasum' => 'kfjwbnkvjw', 'asal_fasum' => 'APBN', 'lat' => '-6.21206340201758', 'lng' => '106.81045532226564', 'gambar' => 'img_fasum/20_IvanoZefanya.png', 'status_aktif' => 0],
            ['idfasum' => 21, 'm_dinas_iddinas' => 1, 'nama' => 'mata sakit', 'luas_fasum' => 2345340, 'kondisi_fasum' => '53453HDFGGHRE', 'asal_fasum' => 'Swasta', 'lat' => '-7.323648', 'lng' => '112.787456', 'gambar' => 'img_fasum/21_matasakit.jpg', 'status_aktif' => 0],
            ['idfasum' => 22, 'm_dinas_iddinas' => 1, 'nama' => 'Stasiun A', 'luas_fasum' => 421, 'kondisi_fasum' => 'Rusak', 'asal_fasum' => 'Swasta', 'lat' => '-7.3241172797651615', 'lng' => '112.7839708328247', 'gambar' => NULL, 'status_aktif' => 0],
            ['idfasum' => 23, 'm_dinas_iddinas' => 1, 'nama' => 'Stasiun Kocag', 'luas_fasum' => 421, 'kondisi_fasum' => 'fwefwe', 'asal_fasum' => 'Swasta', 'lat' => '-7.323648', 'lng' => '112.7776256', 'gambar' => 'img_fasum/23_StasiunKocag.jpg', 'status_aktif' => 1],
            ['idfasum' => 24, 'm_dinas_iddinas' => 1, 'nama' => 'Stasiun Wonokromber', 'luas_fasum' => 421, 'kondisi_fasum' => 'baik', 'asal_fasum' => 'APBN', 'lat' => '-7.3484639041767155', 'lng' => '112.75506734848024', 'gambar' => 'img_fasum/24_StasiunWonokromber.jpg', 'status_aktif' => 1],
        ]);
    }
}
