<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JabatanFungsional extends Model
{
    protected $table = 'v_jafung_akademik';

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }
}
