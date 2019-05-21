<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HakAtasKekayaanIntelektual extends Model
{
    protected $table = 'v_cipta_haki';

    public function newQuery()
    {
        return parent::newQuery()
            ->addSelect([
                'v_cipta_haki.no_haki',
                'v_cipta_haki.nik',
            ])
            ->join('haki', 'v_cipta_haki.no_haki', 'haki.no_haki')
            ->addSelect([
                'haki.judul',
            ])
            ->join('kode_jenis_haki', 'haki.jenis', 'kode_jenis_haki.id_jenis')
            ->addSelect([
                'kode_jenis_haki.jenis',
            ]);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'v_cipta_haki.nik');
    }
}
