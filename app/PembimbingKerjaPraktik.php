<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembimbingKerjaPraktik extends Model
{
    protected $table = 'v_grup_kp';

    public function newQuery()
    {
        return parent::newQuery()
            ->join('v_nilkp', 'v_grup_kp.group_kp', 'v_nilkp.group_kp')
            ->where('');
    }

    public function scopeWhereStatusSelesai($query)
    {
        return $query
            ->where('v_nilkp.status_kp', '*')
            ->where('v_nilkp.nil_akhir', '>', 0);
    }

    public function pembimbing()
    {
        return $this->belongsTo(Karyawan::class, 'v_grup_kp.pembimbing');
    }
}
