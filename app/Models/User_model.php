<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Menggunakan Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User_model extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user'; // Nama tabel di database
    protected $primaryKey = 'iduser'; // Primary key tabel
    public $timestamps = false; // Tidak menggunakan timestamps otomatis

    protected $fillable = [
        'nama',
        'idkota_kabupaten',
        'idjabatan',
        'username',
        'password',
        'alamat',
        'no_hp',
        'email',
        'status_aktif',
        'idstaff',
    ];

    protected $hidden = [
        'password', // Menyembunyikan password
        'remember_token', // Untuk fitur "Remember Me"
    ];

    /**
     * Relasi ke tabel kota.
     */
    public function kota()
    {
        return $this->belongsTo(Kota_model::class, 'idkota_kabupaten');
    }

    /**
     * Relasi ke tabel staff.
     */
    public function staff()
    {
        return $this->belongsTo(Staff_model::class, 'idstaff');
    }
}
