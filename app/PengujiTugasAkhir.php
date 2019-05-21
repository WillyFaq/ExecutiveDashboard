<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengujiTugasAkhir extends Model
{
    protected $table = 'v_jdw_proposal';

    public function newQuery()
    {
        return parent::newQuery()
            ->addSelect([
                'v_propta.semester',
                \DB::Raw('v_jdw_proposal.penguji1 nik_penguji_1'),
                \DB::Raw('v_jdw_proposal.penguji2 nik_penguji_2'),
                'v_propta.mhs_nim',
                'v_propta.tgl_smn',
                'v_propta.jdl_proposal',
            ])
            ->join('v_antri_proposal', 'v_jdw_proposal.kode_antrian', 'v_antri_proposal.kode_antrian')
            ->join('v_propta', 'v_propta.mhs_nim', 'v_antri_proposal.mhs_nim');
    }

    public function scopeWhereStatusSelesai($query)
    {
        return $query
            ->where('v_antri_proposal.sts_proposal', 'Y')
            ->whereNotNull('v_propta.tgl_smn');
    }

    public function penguji1()
    {
        return $this->belongsTo(Karyawan::class, 'nik_penguji_1');
    }

    public function penguji2()
    {
        return $this->belongsTo(Karyawan::class, 'nik_penguji_2');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_nim');
    }
}
