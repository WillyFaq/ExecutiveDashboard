<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriBorang extends Model
{
    protected $table = 'materi_borang';
    protected $primaryKey = 'kd_std';

    public function scopeWhereLayer($query, $layer)
    {
        return $query->where(\DB::Raw('LENGTH(kd_std)'), $layer + 3);
    }

    public function scopeWhereIsKriteriaKhusus($query)
    {
        return $query->where('keterangan', 'KH');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisBorang::class, 'kd_jns');
    }

    public function standar()
    {
        return $this->belongsTo(StandarBorang::class, 'kd_std');
    }

    public function induk_materi()
    {
        return $this->belongsTo(self::class, 'kd_induk');
    }

    public function sub_materi()
    {
        return $this->hasMany(self::class, 'kd_induk');
    }
}
