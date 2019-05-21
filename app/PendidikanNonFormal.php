<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendidikanNonFormal extends Model
{
    protected $table = 'v_pend_informal_kar';

    public function scopeWhereValid($query)
    {
        return $query->whereNotNull('nama_instansi');
    }
}
