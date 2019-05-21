<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekapEwmp extends Model
{
    protected $table = 'rekap_ewmp_lain_pc_prodi';

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }
}
