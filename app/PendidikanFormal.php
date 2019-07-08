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

    public function scopeFilterInJenjang($query, array $filter)
    {
        return $query->whereIn('jenjang_studi', $filter);
    }

    public function scopeFilterOutJenjang($query, array $filter)
    {
        return $query->whereNotIn('jenjang_studi', $filter);
    }

    public function scopeOrderByDefault($query)
    {
        return $query->orderBy(\DB::Raw("CASE jenjang_studi WHEN 'S1' THEN 1 WHEN 'S2' THEN 2 WHEN 'S3' THEN 3 ELSE 0 END"));
    }
}
