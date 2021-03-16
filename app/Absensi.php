<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $guarded = [];
    protected $table = 'absensi';
    
    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'id_pegawai');
    }

    public function kantor()
    {
        return $this->belongsTo('App\Kantor', 'id_kantor');
    }
    

}
