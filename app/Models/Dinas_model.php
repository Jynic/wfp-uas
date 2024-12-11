<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dinas_model extends Model
{
    use HasFactory;
    protected $table = 'm_dinas';
    protected $primaryKey = 'iddinas';
    public $timestamps = false;
    protected $fillable = ['nama', 'idkota_kabupaten', 'alamat', 'status_aktif'];

    public function kota()
    {
        return $this->belongsTo(Kota_model::class, 'idkota_kabupaten');
    }
}
