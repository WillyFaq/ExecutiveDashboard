<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PendaftaranOnline extends Model
{
    protected $table = 'pendaftaran_online';
    protected $primaryKey = 'no_online';
    protected $casts = [
        'tgl_daftar' => 'date',
    ];

    public function scopeWhereSudahBayarForm($query)
    {
        return $query->whereNotNull('no_test');
    }
}
