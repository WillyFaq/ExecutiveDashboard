<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiAngket extends Model
{
    protected $table = 'v_angkttf';

    public function dosen()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }
}
