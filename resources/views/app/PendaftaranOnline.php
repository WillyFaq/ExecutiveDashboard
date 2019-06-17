<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendaftaranOnline extends Model
{
    protected $table = 'pendaftaran_online';
    protected $primaryKey = 'no_online';

    public function scopeWhereSudahBayarForm($query)
    {
        return $query->whereNotNull('no_test');
    }
}
