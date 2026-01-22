<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'img',
        'password',
        'role',
        'status',
        'guru_id',
        'siswa_id',
        'bendahara_id',
        'tata_usaha_id'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'verification_sent_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
        public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function bendahara()
    {
        return $this->belongsTo(Bendahara::class, 'bendahara_id');
    }
    public function tata_usaha()
    {
        return $this->belongsTo(TataUsaha::class, 'tata_usaha_id');
    }

}
