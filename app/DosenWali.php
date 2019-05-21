<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DosenWali extends Model
{
    protected $table = 'v_his_kul';

    public function newQuery()
    {
        return parent::newQuery()
            ->addSelect([
                'dosen_wl',
                'nim',
                'semester',
            ]);
    }

    public function dosen()
    {
        return $this->belongsTo(Karyawan::class, 'dosen_wl');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
}
