<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaporanadmin_model extends Model
{
    use HasFactory;
    protected $table = 't_pelaporan';
    protected $primaryKey = 'idpelaporan';
    public $timestamps = false;
    protected $fillable = ['nomor', 'tgl_pelaporan', 'idm_staff', 'iduser', 'status_pelaporan', 'keterangan', 'status_aktif'];

    public function detail()
    {
        return $this->belongsToMany(Fasum_model::class, 't_pelaporan_detail', 't_pelaporan_idpelaporan', 'id_pelaporan')->withPivot('status_perbaikkan', 'foto_fasum', 'keterangan');
    }
    public function staff()
    {
        return $this->belongsTo(Staff_model::class, 'idm_staff', 'idm_staff');
    }
    public function  user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
