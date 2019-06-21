<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'v_fakultas';
    protected $primaryKey = 'id';

    public function newQuery()
    {
        return parent::newQuery()
        ->whereNotIn('id', ['41011', '39090']);
    }

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

    public function getAliasAttribute()
    {
        return 'D3' == substr($this->attributes['alias'], 0, 2) ? $this->attributes['alias'] : substr($this->attributes['alias'], 3);
    }
}
