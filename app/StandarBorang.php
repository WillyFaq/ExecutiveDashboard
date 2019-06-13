<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StandarBorang extends Model
{
    protected $table = 'standard_borang';
    protected $primaryKey = 'kd_std';
    protected $connection = 'oracle_stikom_dev';

    public function nilai()
    {
        return $this->hasMany(NilaiBorang::class, 'kd_std');
    }
}
