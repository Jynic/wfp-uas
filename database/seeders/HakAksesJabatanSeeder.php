<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HakAksesJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('a_hak_akses_jabatan')->insert([
            ['idhak_akses' => 1, 'idjabatan' => 1],
            ['idhak_akses' => 2, 'idjabatan' => 1],
            ['idhak_akses' => 3, 'idjabatan' => 1],
            ['idhak_akses' => 4, 'idjabatan' => 1],
            ['idhak_akses' => 5, 'idjabatan' => 1],
            ['idhak_akses' => 6, 'idjabatan' => 1],
            ['idhak_akses' => 7, 'idjabatan' => 1],
            ['idhak_akses' => 8, 'idjabatan' => 1],
            ['idhak_akses' => 9, 'idjabatan' => 1],
            ['idhak_akses' => 10, 'idjabatan' => 1],
            ['idhak_akses' => 11, 'idjabatan' => 1],
            ['idhak_akses' => 7, 'idjabatan' => 2],
            ['idhak_akses' => 9, 'idjabatan' => 2],
            ['idhak_akses' => 1, 'idjabatan' => 3],
            ['idhak_akses' => 2, 'idjabatan' => 3],
            ['idhak_akses' => 3, 'idjabatan' => 3],
            ['idhak_akses' => 4, 'idjabatan' => 3],
            ['idhak_akses' => 5, 'idjabatan' => 3],
            ['idhak_akses' => 6, 'idjabatan' => 3],
            ['idhak_akses' => 7, 'idjabatan' => 3],
            ['idhak_akses' => 8, 'idjabatan' => 3],
            ['idhak_akses' => 9, 'idjabatan' => 3],
            ['idhak_akses' => 10, 'idjabatan' => 3],
            ['idhak_akses' => 11, 'idjabatan' => 3],
        ]);
    }
}
