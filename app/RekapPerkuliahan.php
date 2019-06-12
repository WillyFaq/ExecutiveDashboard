<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekapPerkuliahan extends Model
{
    protected $table = 'v_rkp';

    public function dosen()
    {
        return $this->belongsTo(Karyawan::class, 'jkul_kary_nik');
    }
}
