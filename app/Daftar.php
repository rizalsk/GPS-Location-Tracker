<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    protected $table = 'daftar';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'kejuruan_id', 'nama', 'tempat', 'tgl_lahir', 'alamat', 'telepon', 'pendidikan', 'kk', 'ktp', 'ijazah', 'img', 'no_pendaftaran', 'status', 'thn_pendaftaran',
    ];
}
