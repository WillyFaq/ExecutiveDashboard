<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndeksKinerjaDosen extends Model
{
    protected $table = 'v_idx_kerja_dosen';

    public function dosen()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }
}
