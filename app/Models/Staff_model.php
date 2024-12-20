<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff_model extends Model
{
    use HasFactory;
    protected $table = 'm_staff';
    protected $primaryKey = 'idm_staff';
    public $timestamps = false;
    protected $fillable = ['nama', 'iddinas', 'idjabatan', 'username', 'password', 'status_aktif'];

    public function dinas()
    {
        return $this->belongsTo(Dinas_model::class, 'iddinas');
    }
}
