<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];
    protected $table = 'report';
    public $timestamps = false;

    public function absensi()
    {
        return $this->belongsTo('App\Absensi', 'id_absensi');
    }

    /*public function pegawai()
    {
        return $this->hasOneThrough(
            'App\Pegawai',
            'App\Absensi',
            'id', // Foreign key on Absensi table...
            'id', // Foreign key on Pegawai table...
            'id_absensi', // Local key on Report table...
            'id_pegawi' // Local key on Absensi table...
        );
    }*/
    
}
