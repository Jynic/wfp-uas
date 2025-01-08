<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historypelaporan_model extends Model
{
    use HasFactory;

    protected $table = 't_history_perbaikan';

    protected $primaryKey = 'idhistory';

    protected $fillable = [
        'idpelaporan',
        'tgl_perubahan',
        'status_sebelumnya',
        'status_setelahnya',
        'keterangan',
        'idstaff',
    ];

    public $timestamps = false;

    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan_model::class, 'idpelaporan', 'idpelaporan');
    }

    public function staff()
    {
        return $this->belongsTo(Staff_model::class, 'idstaff');
    }
}
