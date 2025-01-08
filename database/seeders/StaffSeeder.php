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
        ]);
    }
}
