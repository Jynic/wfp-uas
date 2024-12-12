<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenisfasum_model extends Model
{
    use HasFactory;
    protected $table = 'm_kategori_fasum';
    protected $primaryKey = 'idkategori_fasum';
    public $timestamps = false;
    protected $fillable = ['nama'];
}
