<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class HistoryPerbaikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_history_perbaikan')->insert([
            [
                'idhistory_perbaikan' => 1,
                'idpelaporan' => 9,
                'tgl' => '2024-12-26 10:27:49',
                'keterangan' => 'Pelaporan Selesai'
            ]
        ]);
    }
}
