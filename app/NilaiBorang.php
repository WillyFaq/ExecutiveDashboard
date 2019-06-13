<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiBorang extends Model
{
    protected $table = 'nilai_borang';
    protected $primaryKey = 'kd_std';
    protected $connection = 'oracle_stikom_dev';

    public function materi()
    {
        return $this->belongsTo(MateriBorang::class, 'kd_std');
    }
}
