<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembimbingTugasAkhir extends Model
{
    protected $table = 'v_propta';

    public function newQuery()
    {
        return parent::newQuery()
            ->addSelect([
                'v_propta.semester',
                \DB::Raw('v_propta.pembimbing_1 AS nik_pembimbing_1'),
                \DB::Raw('v_propta.pembimbing_2 AS nik_pembimbing_2'),
                'v_propta.mhs_nim',
                'tgl_smn',
                'v_propta.jdl_proposal',
            ])
            ->join('v_antri_proposal', 'v_propta.mhs_nim', 'v_antri_proposal.mhs_nim');
    }

    public function scopeWhereStatusSelesai($query)
    {
        return $query
            ->where('v_antri_proposal.sts_proposal', 'Y')
            ->whereNotNull('v_propta.tgl_smn');
    }

    public function pembimbing1()
    {
        return $this->belongsTo(Karyawan::class, 'nik_pembimbing_1');
    }

    public function pembimbing2()
    {
        return $this->belongsTo(Karyawan::class, 'nik_pembimbing_2');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_nim');
    }
}
