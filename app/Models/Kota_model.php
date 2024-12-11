<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota_model extends Model
{
    use HasFactory;
    protected $table = 'm_kota_kabupaten';
    protected $primaryKey = 'idkota_kabupaten';
    public $timestamps = false;
    protected $fillable = ['kode', 'nama', 'jenis', 'm_provinsi_idprovinsi', 'status_aktif'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi_model::class, 'm_provinsi_idprovinsi');
    }
}
