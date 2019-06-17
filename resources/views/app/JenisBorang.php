<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBorang extends Model
{
    protected $table = 'jenis_borang';
    protected $primaryKey = 'kd_jns';
    protected $connection = 'oracle_stikom_dev';
}
