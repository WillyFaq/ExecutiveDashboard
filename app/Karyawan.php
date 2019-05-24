<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'v_karyawan';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $casts = [
        'nik' => 'string',
        'nidn' => 'string',
        'nidk' => 'string',
        'nup' => 'string',
    ];

    public function newQuery()
    {
        return parent::newQuery()
            ->addSelect([
                'v_karyawan.nik',
                \DB::Raw('nip nidn'),
                'nidk',
                'nup',
                \DB::Raw('nama_plus_gelar(v_karyawan.nik) AS NAMA'),
            ])
            ->leftJoin('v_email_kar', 'v_karyawan.nik', 'v_email_kar.nik')
            ->addSelect([
                'v_email_kar.email',
            ])
            ->leftJoin('v_prodiewmp', 'v_karyawan.nik', 'v_prodiewmp.nik')
            ->addSelect(['v_prodiewmp.prodi']);
    }

    public function scopeWhereIsAktif($query)
    {
        return $query->where('status', 'A');
    }

    public function scopeWhereIsDosen($query)
    {
        return $query->where('kary_type', 'LIKE', '%D%');
    }

    public function scopeWhereIsDosenTetap($query)
    {
        return $query->where('kary_type', 'TD');
    }

    public function scopeWhereIsDosenTidakTetap($query)
    {
        return $query->whereIsDosen()->where('kary_type', '!=', 'TD');
    }
}
