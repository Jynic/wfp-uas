<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'm_user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'pass'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function kota()
    {
        return $this->belongsTo(Kota_model::class, 'idkota_kabupaten');
    }

    public function staff()
    {
        return $this->belongsTo(Staff_model::class, 'idstaff');
    }
}
