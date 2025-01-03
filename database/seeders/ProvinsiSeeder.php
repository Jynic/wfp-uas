<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_provinsi')->insert([
            [
                'idprovinsi' => 1,
                'kode' => "JTM",
                'nama' => "Jawa Timur",
                'status_aktif' => 1,
            ],
        ]);
    }
}
