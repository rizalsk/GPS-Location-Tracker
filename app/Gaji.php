<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $guarded = [];
    protected $table = 'gaji';
    
    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'id_pegawai');
    }
    

}
