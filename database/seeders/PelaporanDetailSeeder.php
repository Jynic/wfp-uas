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
                'status_perbaikkan' => 'Antri',
                'foto_fasum' => '-',
                'keterangan' => 'Fasum ini rusak total',
            ],
            [
                'iddetail' => 2,
                't_pelaporan_idpelaporan' => 1,
                'm_fasum_idfasum' => 2,
                'status_perbaikkan' => 'Antri',
                'foto_fasum' => '-',
                'keterangan' => 'Fasum ini kotor saja',
            ],

        ]);
    }
}
