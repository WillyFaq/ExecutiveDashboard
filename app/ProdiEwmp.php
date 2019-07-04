<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdiEwmp extends Model
{
    protected $table = 'v_prodiewmp';

    public function newQuery()
    {
        return parent::newQuery()
        ->addSelect(['nik', 'prodi']);
    }

    public function program_studi()
    {
        return $this->belongsTo(Prodi::class, 'prodi');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }
}
