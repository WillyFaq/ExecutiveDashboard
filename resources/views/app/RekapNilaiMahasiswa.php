<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekapNilaiMahasiswa extends Model
{
    protected $table = 'v_transk';

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_nim');
    }
}
