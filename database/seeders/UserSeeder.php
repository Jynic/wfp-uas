<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('m_user')->insert([
            [
                'iduser' => 2,
                'idkota_kabupaten' => 1,
                'idjabatan' => 2,
                'nama' => 'ridwan',
                'username' => 'ridwan',
                'password' => '$2y$10$Dnbcdv5v4BMpgcNwHy896OXCgxyDD/DkgGEXpW/kACJfU5SoVGFvq',
                'alamat' => 'Jalan Rungkut No 31',
                'no_hp' => '12324525345',
                'email' => 'ridwan@gmail.com',
                'status_aktif' => 1,
                'idstaff' => 10
            ],
            [
                'iduser' => 3,
                'idkota_kabupaten' => 1,
                'idjabatan' => 2,
                'nama' => 'ramli',
                'username' => 'ramli',
                'password' => '$2y$10$XkB33y6H1i6yROocZ9/2pu6fqvGKXYFgjNx4T2nt8y6ZrOPVhcM.q',
                'alamat' => 'Jalan Rungkut No 31',
                'no_hp' => '12334578',
                'email' => 'ramli@gmail.com',
                'status_aktif' => 1,
                'idstaff' => 11
            ],
            [
                'iduser' => 4,
                'idkota_kabupaten' => 1,
                'idjabatan' => 3,
                'nama' => 'ivano',
                'username' => 'ivano',
                'password' => '$2y$10$XkB33y6H1i6yROocZ9/2pu6fqvGKXYFgjNx4T2nt8y6ZrOPVhcM.q',
                'alamat' => 'Jalan Rungkut No 31',
                'no_hp' => '12313425',
                'email' => 'ivano@gmail.com',
                'status_aktif' => 1,
                'idstaff' => 6
            ]
        ]);
    }
}
