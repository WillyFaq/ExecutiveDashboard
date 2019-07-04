<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BerkasPortofolio extends Model
{
    protected $table = 'berkas_portofolio_dosen';
    protected $primaryKey = 'id_berkas';
    protected $connection = 'oracle_stikom_dev';

    public function jenis_berkas_portofolio()
    {
        return $this->belongsTo(JenisBerkasPortofolio::class, 'id_jenis');
    }
}
