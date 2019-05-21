<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendidikanFormal extends Model
{
    protected $table = 'v_pend_formal_kar';

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }

    public function scopeWhereValid($query)
    {
        return  $query->whereNotNull('nama_sekolah');
    }

    public function scopeFilterJenjang($query = ['SD', 'SLTP', 'SMTP', 'SMU'])
    {
        return $query->whereNotIn('jenjang', $query);
    }
}
