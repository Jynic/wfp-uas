<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_jabatan')->insert([
            ['idjabatan' => 1, 'nama' => 'Admin', 'status_aktif' => 1],
            ['idjabatan' => 2, 'nama' => 'User', 'status_aktif' => 1],
            ['idjabatan' => 3, 'nama' => 'Manager', 'status_aktif' => 1],
        ]);
    }
}
