<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriAjar extends Model
{
    protected $table = 'rekap_mf';

    public function newQuery()
    {
        return parent::newQuery()
        ->addSelect([
            'rekap_mf.jkul_kary_nik',
            'rekap_mf.semester',
            'rekap_mf.jkul_klkl_id',
        ])
        ->join('kurlkl_mf', function ($join) {
            return $join
            ->on('rekap_mf.jkul_klkl_id', 'kurlkl_mf.id')
            ->on('rekap_mf.prodi', 'kurlkl_mf.fakul_id');
        })
        ->addSelect([
            'kurlkl_mf.sks',
        ])
        ->whereIsValid();
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'jkul_kary_nik');
    }

    public function scopeOrderBySemester($query)
    {
        return $query->orderBy(\DB::Raw("TO_DATE(SUBSTR(rekap_mf.semester,1,2),'RR')"));
    }

    public function scopeWhereIsValid($query)
    {
        return $query->where('sts_dosen', '*');
    }
}
