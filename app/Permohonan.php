<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $guarded = [];
    protected $table = 'permohonan';
    
    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'id_pegawai');
    }

    /*public function pegawai()
    {
        return $this->hasOne('App\Pegawai', 'id_pegawai');
    }*/
}
