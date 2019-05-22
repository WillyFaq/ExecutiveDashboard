<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekapEwmp extends Model
{
    protected $table = 'rekap_ewmp_lain_pc_prodi';

    public function scopeWhereIsPenelitian($query)
    {
        return $query
            ->where('jenis', 1)
            ->where('bidang', 'B');
    }

    public function scopeWhereIsArtikelJurnal($query)
    {
        return $query
            ->where('jenis', 2)
            ->where('bidang', 'B');
    }

    public function scopeWhereIsBuku($query)
    {
        return $query
            ->where('jenis', 3)
            ->where('bidang', 'B');
    }

    public function scopeWhereIsHibahPengabdian($query)
    {
        return $query->where('bidang', 'C');
    }

    public function scopeWhereIsPelatihan($query)
    {
        return $query->where('bidang', 'C');
    }

    public function scopeWhereIsKepanitiaan($query)
    {
        return $query->where('bidang', 'D');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }
}
