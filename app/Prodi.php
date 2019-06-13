<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'v_fakultas';
    protected $primaryKey = 'id';

    public function scopeWhereIsAktif($query)
    {
        return $query->where('sts_aktif', 'Y');
    }

    public function prodi_ewmp()
    {
        return $this->hasMany(ProdiEwmp::class, 'prodi');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas');
    }

    public function mata_kuliah()
    {
        return $this->hasMany(MataKuliah::class, 'fakul_id');
    }
}
