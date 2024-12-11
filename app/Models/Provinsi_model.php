<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi_model extends Model
{
    use HasFactory;
    protected $table = 'm_provinsi';
    protected $primaryKey = 'idprovinsi';
    public $timestamps = false;
    protected $fillable = ['kode', 'nama', 'status_aktif'];
}
