<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table = 'v_mutasi_kar';

    public function newQuery()
    {
        return parent::newQuery()
            ->addSelect([
                'no_mutasi',
                'bagian',
                'bagian_lama',
                'jabatan',
                'keterangan',
                'tanggal',
            ]);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }
}
