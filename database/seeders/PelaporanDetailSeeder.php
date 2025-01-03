<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelaporanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_pelaporan_detail')->insert([
            [
                'iddetail' => 1,
                't_pelaporan_idpelaporan' => 1,
                'm_fasum_idfasum' => 16,
                'status_perbaikkan' => 'Antri',
                'foto_fasum' => '-',
                'keterangan' => 'Test 2',
                'idstaff' => 11
            ],
            [
                'iddetail' => 3,
                't_pelaporan_idpelaporan' => 4,
                'm_fasum_idfasum' => 23,
                'status_perbaikkan' => 'Antri',
                'foto_fasum' => '-',
                'keterangan' => 'ttttt',
                'idstaff' => 9
            ],
            [
                'iddetail' => 4,
                't_pelaporan_idpelaporan' => 4,
                'm_fasum_idfasum' => 23,
                'status_perbaikkan' => 'Antri',
                'foto_fasum' => '-',
                'keterangan' => 'hhhh',
                'idstaff' => 10
            ],
            [
                'iddetail' => 6,
                't_pelaporan_idpelaporan' => 5,
                'm_fasum_idfasum' => 23,
                'status_perbaikkan' => 'Antri',
                'foto_fasum' => '-',
                'keterangan' => 'test hapus',
                'idstaff' => 9
            ],
            [
                'iddetail' => 7,
                't_pelaporan_idpelaporan' => 6,
                'm_fasum_idfasum' => 23,
                'status_perbaikkan' => 'Antri',
                'foto_fasum' => '-',
                'keterangan' => 'ttt',
                'idstaff' => 9
            ],
            [
                'iddetail' => 8,
                't_pelaporan_idpelaporan' => 7,
                'm_fasum_idfasum' => 23,
                'status_perbaikkan' => 'Antri',
                'foto_fasum' => '-',
                'keterangan' => '11111',
                'idstaff' => 6
            ],
            [
                'iddetail' => 9,
                't_pelaporan_idpelaporan' => 7,
                'm_fasum_idfasum' => 23,
                'status_perbaikkan' => 'Antri',
                'foto_fasum' => '-',
                'keterangan' => '222222',
                'idstaff' => 9
            ],
            [
                'iddetail' => 16,
                't_pelaporan_idpelaporan' => 8,
                'm_fasum_idfasum' => 23,
                'status_perbaikkan' => 'Antri',
                'foto_fasum' => 'img_pelaporan/8_detail_0.jpg',
                'keterangan' => 'tttt',
                'idstaff' => 6
            ],
            [
                'iddetail' => 17,
                't_pelaporan_idpelaporan' => 8,
                'm_fasum_idfasum' => 23,
                'status_perbaikkan' => 'Outsource',
                'foto_fasum' => 'img_pelaporan/9_detail_0.jpg',
                'keterangan' => 'hhh',
                'idstaff' => 9
            ],
            [
                'iddetail' => 46,
                't_pelaporan_idpelaporan' => 9,
                'm_fasum_idfasum' => 23,
                'status_perbaikkan' => 'Dikerjakan',
                'foto_fasum' => 'img_pelaporan/9_detail_0.jpg',
                'keterangan' => 'tttt',
                'idstaff' => 8
            ],
            [
                'iddetail' => 47,
                't_pelaporan_idpelaporan' => 9,
                'm_fasum_idfasum' => 23,
                'status_perbaikkan' => 'Dikerjakan',
                'foto_fasum' => 'img_pelaporan/9_detail_1.jpg',
                'keterangan' => 'tttt',
                'idstaff' => 8
            ]
        ]);
    }
}
