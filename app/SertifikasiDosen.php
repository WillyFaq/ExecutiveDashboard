<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SertifikasiDosen extends Model
{
    const SERTIFIKASI_PENDIDIK_PROFESIONAL = 1;
    const SERTIFIKASI_PROFESI = 2;
    const SERTIFIKASI_KOMPETENSI = 3;

    protected $table = 'sertifikasi_dosen';
    protected $connection = 'oracle_stikom_dev';
}
