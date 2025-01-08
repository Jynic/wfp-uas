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
                'm_fasum_idfasum' => 1,
                'foto_fasum' => '-',
                'keterangan' => 'Fasum ini rusak total',
            ],
            [
                'iddetail' => 2,
                't_pelaporan_idpelaporan' => 1,
                'm_fasum_idfasum' => 2,
                'foto_fasum' => '-',
                'keterangan' => 'Fasum ini kotor saja',
            ],
            [
                'iddetail' => 3,
                't_pelaporan_idpelaporan' => 2,
                'm_fasum_idfasum' => 3,
                'foto_fasum' => '-',
                'keterangan' => 'Fasum ini rusak saja',
            ],
            [
                'iddetail' => 4,
                't_pelaporan_idpelaporan' => 2,
                'm_fasum_idfasum' => 8,
                'foto_fasum' => '-',
                'keterangan' => 'Fasum ini kotor saja',
            ],
            [
                'iddetail' => 5,
                't_pelaporan_idpelaporan' => 3,
                'm_fasum_idfasum' => 4,
                'foto_fasum' => '-',
                'keterangan' => 'Fasum ini rusak saja',
            ],
            [
                'iddetail' => 6,
                't_pelaporan_idpelaporan' => 4,
                'm_fasum_idfasum' => 5,
                'foto_fasum' => '-',
                'keterangan' => 'Fasum ini rusak saja',
            ],

        ]);
    }
}
