<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembinaUnitKegiatanMahasiswa extends Model
{
    protected $table = 'v_pmb_ukm';

    public function newQuery()
    {
        return parent::newQuery()
        ->addSelect([
            \DB::Raw('SUBSTR(nosk,-4,4) tahun'),
            'nik',
            'nosk',
            'nama_ukm',
            'sie',
        ]);
    }

    public function pembina()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }
}
