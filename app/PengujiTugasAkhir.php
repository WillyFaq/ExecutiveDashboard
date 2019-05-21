<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengujiTugasAkhir extends Model
{
    protected $table = 'v_jdw_proposal';

    public function newQuery()
    {
        return parent::newQuery()
            ->join('v_antri_proposal', 'v_propta.mhs_nim', 'v_antri_proposal.mhs_nim')
            ->join('v_propta', 'v_propta.mhs_nim', 'v_antri_proposa.mhs_nim');
    }

    public function scopeWhereStatusSelesai($query)
    {
        return $query
            ->where('v_antri_proposal.sts_proposal', 'Y')
            ->whereNotNull('v_propta.tgl_smn');
    }

    public function penguji1()
    {
        return $this->belongsTo(Karyawan::class, 'v_propta.penguji1');
    }

    public function penguji2()
    {
        return $this->belongsTo(Karyawan::class, 'v_propta.penguji2');
    }
}
