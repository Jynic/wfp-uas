<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_staff')->insert([
            [
                'idm_staff' => 1,
                'iddinas' => 1,
                'idjabatan' => 1,
                'nama' => 'admin',
                'username' => 'admin',
                'status_aktif' => 1,
                'alamat' => 'Jalan Rungkut No 31',
                'email' => 'admin@gmail.com',
            ],
            [
                'idm_staff' => 2,
                'iddinas' => 1,
                'idjabatan' => 3,
                'nama' => 'ivano',
                'username' => 'ivano',
                'status_aktif' => 1,
                'alamat' => 'Jalan ivano No 31',
                'email' => 'ivano@gmail.com',
            ],
            [
                'idm_staff' => 3,
                'iddinas' => 1,
                'idjabatan' => 4,
                'nama' => 'ryan',
                'username' => 'ryan',
                'status_aktif' => 1,
                'alamat' => 'Jalan ryan No 31',
                'email' => 'ryan@gmail.com',
            ],
        ]);
    }
}
