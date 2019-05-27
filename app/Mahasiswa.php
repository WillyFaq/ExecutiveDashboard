<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'v_mhs';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $casts = [
        'nim' => 'string',
    ];

    public function dosen_wali()
    {
        return $this->belongsTo(Karyawan::class, 'dosen_wl');
    }

    public function histori_kuliah()
    {
        return $this->hasMany(HistoriKuliah::class, 'mhs_nim');
    }
}
