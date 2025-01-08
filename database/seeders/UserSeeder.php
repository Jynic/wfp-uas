<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('m_user')->insert([
            [
                'iduser' => 1,
                'idkota_kabupaten' => 1,
                'idjabatan' => 1,
                'nama' => 'admin',
                'username' => 'admin',
                'password' => Hash::make("admin"),
                'alamat' => 'Jalan Rungkut No 31',
                'no_hp' => '12324525345',
                'email' => 'admin@gmail.com',
                'status_aktif' => 1,
                'idstaff' => 1
            ],
        ]);
        DB::table('m_user')->insert([
            [
                'iduser' => 2,
                'idkota_kabupaten' => '1',
                'idjabatan' => '4',
                'nama' => 'ryan',
                'username' => 'ryan',
                'password' => Hash::make("ryan"),
                'status_aktif' => 1,
                'alamat' => 'Jalan ryan No 31',
                'no_hp' => '123123123',
                'email' => 'ryan@gmail.com',
            ],
            [
                'iduser' => 3,
                'idkota_kabupaten' => '1',
                'idjabatan' => '3',
                'nama' => 'ivano',
                'username' => 'ivano',
                'password' => Hash::make("ivano"),
                'status_aktif' => 1,
                'alamat' => 'Jalan ivano No 31',
                'no_hp' => '123123123',
                'email' => 'ivano@gmail.com',
            ],
        ]);
        DB::table('m_user')->insert([
            [
                'iduser' => 4,
                'nama' => 'zefa',
                'username' => 'zefa',
                'password' => Hash::make("zefa"),
                'status_aktif' => 1,
            ],
            [
                'iduser' => 5,
                'nama' => 'niko',
                'username' => 'niko',
                'password' => Hash::make("niko"),
                'status_aktif' => 1,
            ],
        ]);
        // DB::table('m_user')->insert([
        //     [
        //         'iduser' => 2,
        //         'idkota_kabupaten' => 1,
        //         'idjabatan' => 2,
        //         'nama' => 'ridwan',
        //         'username' => 'ridwan',
        //         'password' => '$2y$10$Dnbcdv5v4BMpgcNwHy896OXCgxyDD/DkgGEXpW/kACJfU5SoVGFvq',
        //         'alamat' => 'Jalan Rungkut No 31',
        //         'no_hp' => '12324525345',
        //         'email' => 'ridwan@gmail.com',
        //         'status_aktif' => 1,
        //         'idstaff' => 10
        //     ],
        //     [
        //         'iduser' => 3,
        //         'idkota_kabupaten' => 1,
        //         'idjabatan' => 2,
        //         'nama' => 'ramli',
        //         'username' => 'ramli',
        //         'password' => '$2y$10$XkB33y6H1i6yROocZ9/2pu6fqvGKXYFgjNx4T2nt8y6ZrOPVhcM.q',
        //         'alamat' => 'Jalan Rungkut No 31',
        //         'no_hp' => '12334578',
        //         'email' => 'ramli@gmail.com',
        //         'status_aktif' => 1,
        //         'idstaff' => 11
        //     ],
        //     [
        //         'iduser' => 4,
        //         'idkota_kabupaten' => 1,
        //         'idjabatan' => 3,
        //         'nama' => 'ivano',
        //         'username' => 'ivano',
        //         'password' => '$2y$10$XkB33y6H1i6yROocZ9/2pu6fqvGKXYFgjNx4T2nt8y6ZrOPVhcM.q',
        //         'alamat' => 'Jalan Rungkut No 31',
        //         'no_hp' => '12313425',
        //         'email' => 'ivano@gmail.com',
        //         'status_aktif' => 1,
        //         'idstaff' => 6
        //     ]
        // ]);
    }
}
