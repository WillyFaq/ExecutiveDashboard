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
                'nik',
                \DB::Raw('bagian AS kode_bagian_baru'),
                \DB::Raw('bagian_lama AS kode_bagian_lama'),
                'jabatan',
                'keterangan',
                'tanggal',
            ]);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }

    public function bagian_lama()
    {
        return $this->belongsTo(Bagian::class, 'kode_bagian_lama');
    }

    public function bagian_baru()
    {
        return $this->belongsTo(Bagian::class, 'kode_bagian_baru');
    }
}
