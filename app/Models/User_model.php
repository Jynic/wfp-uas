<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_model extends Model
{
    use HasFactory;
    protected $table = 'm_user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;
    protected $fillable = ['nama', 'idkota_kabupaten', 'idjabatan', 'username', 'password','alamat','no_hp','email', 'status_aktif'];

    public function kota(){
        return $this->belongsTo(Kota_model::class, 'idkota_kabupaten');
    }
}
