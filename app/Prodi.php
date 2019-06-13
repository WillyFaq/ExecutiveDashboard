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
}
