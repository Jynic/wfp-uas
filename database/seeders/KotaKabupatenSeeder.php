<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotaKabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_kota_kabupaten')->insert([
            ['idkota_kabupaten' => 1, 'kode' => 'Sby', 'nama' => 'Kota Surabaya', 'jenis' => 'kota', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 1],
            ['idkota_kabupaten' => 2, 'kode' => 'Gto', 'nama' => 'Gorontalo', 'jenis' => 'kota', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 2],
            ['idkota_kabupaten' => 3, 'kode' => 'PRE', 'nama' => 'Pare', 'jenis' => 'kabupaten', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 7],
            ['idkota_kabupaten' => 4, 'kode' => 'Sdg', 'nama' => 'Sidoarjo', 'jenis' => 'kabupaten', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 1],
            ['idkota_kabupaten' => 5, 'kode' => 'Mlg', 'nama' => 'Malang', 'jenis' => 'kota', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 1],
            ['idkota_kabupaten' => 6, 'kode' => 'Kdl', 'nama' => 'Kediri', 'jenis' => 'kota', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 1],
            ['idkota_kabupaten' => 7, 'kode' => 'Bdg', 'nama' => 'Kota Bandung', 'jenis' => 'kota', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 3],
            ['idkota_kabupaten' => 8, 'kode' => 'Bks', 'nama' => 'Kota Bekasi', 'jenis' => 'kota', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 3],
            ['idkota_kabupaten' => 9, 'kode' => 'Bgr', 'nama' => 'Kota Bogor', 'jenis' => 'kota', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 3],
            ['idkota_kabupaten' => 10, 'kode' => 'Slw', 'nama' => 'Kota Salatiga', 'jenis' => 'kota', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 4],
            ['idkota_kabupaten' => 11, 'kode' => 'Smg', 'nama' => 'Kota Semarang', 'jenis' => 'kota', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 4],
            ['idkota_kabupaten' => 12, 'kode' => 'Mgl', 'nama' => 'Kota Magelang', 'jenis' => 'kota', 'status_aktif' => 1, 'm_provinsi_idprovinsi' => 4],
        ]);
    }
}
