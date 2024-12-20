<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorifasum_model extends Model
{
    use HasFactory;
    protected $table = 'm_kategori_fasum_has_m_fasum';
    protected $primaryKey = 'idfasum';
    public $timestamps = false;
    protected $fillable = ['nama', 'm_dinas_iddinas', 'luas_fasum', 'kondisi_fasum', 'asal_fasum', 'lat', 'lng', 'gambar', 'status_aktif'];

    public function dinas()
    {
        return $this->belongsTo(Dinas_model::class, 'm_dinas_iddinas');
    }
}
