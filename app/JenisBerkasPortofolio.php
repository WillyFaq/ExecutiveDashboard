<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBerkasPortofolio extends Model
{
    protected $table = 'jenis_berkas_portofolio_dosen';
    protected $primaryKey = 'id_jenis';
    protected $connection = 'oracle_stikom_dev';

    public function berkas_portofolio()
    {
        return $this->hasMany(BerkasPortofolio::class, 'id_jenis');
    }
}
