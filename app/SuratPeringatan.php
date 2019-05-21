<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratPeringatan extends Model
{
    protected $table = 'v_kary_note';

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }
}
