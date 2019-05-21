<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembimbingKerjaPraktik extends Model
{
    protected $table = 'v_grup_kp';

    public function newQuery()
    {
        return parent::newQuery()
            ->addSelect([
                \DB::Raw('substr(v_grup_kp.group_kp,1,3) semester'),
                \DB::Raw('pembimbing nik_pembimbing'),
                'object_kp',
                'tgl_awal',
                'tgl_akhir',
            ])
            ->join('v_nilkp', 'v_grup_kp.group_kp', 'v_nilkp.group_kp')
            ->addSelect([
                'mhs_nim',
            ]);
    }

    public function scopeWhereStatusSelesai($query)
    {
        return $query
            ->where('v_nilkp.status_kp', '*')
            ->where('v_nilkp.nil_akhir', '>', 0);
    }

    public function pembimbing()
    {
        return $this->belongsTo(Karyawan::class, 'nik_pembimbing');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_nim');
    }
}
