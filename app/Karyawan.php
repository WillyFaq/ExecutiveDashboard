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
            ->join('v_email_kar', 'v_karyawan.nik', 'v_email_kar.nik')
            ->addSelect([
                'v_email_kar.email',
            ]);
    }

    public function scopeWhereIsDosen($query)
    {
        return $query->where('kary_type', 'LIKE', '%D%');
    }
}
