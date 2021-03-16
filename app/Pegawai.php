<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    use Notifiable;

    protected $table = 'pegawai';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jabatan',
        'departemen',
        'alamat',
        'telp',
        'username',
        'password',
        'email',
        'level',
        'foto',
        'gaji_pokok',
        'bpjs_tk',
        'bpjs_kesehatan',
        'bpjs_jht',
        'uang_makan',
        'uang_transport',
        'mulai_kerja',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }
    
    public function permohonan()
    {
        return $this->hasMany('App\Permohonan', 'id_pegawai' , 'id');
    }
}
