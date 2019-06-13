<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriAjar extends Model
{
    protected $table = 'jdwkul_his';

    public function newQuery()
    {
        return parent::newQuery()
        ->addSelect([
            'jdwkul_his.kary_nik',
            'jdwkul_his.smt',
            'jdwkul_his.klkl_id',
        ])
        ->join('kurlkl_mf', function ($join) {
            return $join
            ->on('jdwkul_his.klkl_id', 'kurlkl_mf.id')
            ->on('jdwkul_his.prodi', 'kurlkl_mf.fakul_id');
        })
        ->addSelect([
            'kurlkl_mf.sks',
        ]);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'kary_nik');
    }
}
