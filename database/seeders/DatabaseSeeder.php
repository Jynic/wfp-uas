<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            HakAksesSeeder::class,
            JabatanSeeder::class,
            ProvinsiSeeder::class,
            KotaKabupatenSeeder::class,
            DinasSeeder::class,
            JenisFasumSeeder::class,
            KategoriFasumSeeder::class,
            FasumSeeder::class,
            KategoriFasumHasFasumSeeder::class,
            HakAksesJabatanSeeder::class,
            StaffSeeder::class,
            UserSeeder::class,
            PelaporanSeeder::class,
            PelaporanDetailSeeder::class,
            HistoryPerbaikanSeeder::class,
        ]);
    }
}
