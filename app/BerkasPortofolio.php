<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BerkasPortofolio extends Model
{
    protected $table = 'berkas_portofolio_dosen';
    protected $primaryKey = 'id_berkas';
    protected $connection = 'oracle_stikom_dev';

    public function newQuery()
    {
        return parent::newQuery()
        ->addSelect([
            'id_berkas',
            'nik',
            \DB::Raw('berkas_portofolio_dosen.id_jenis'),
            'file_path',
        ])
        ->leftJoin('jenis_berkas_portofolio_dosen', 'berkas_portofolio_dosen.id_jenis', 'jenis_berkas_portofolio_dosen.id_jenis')
        ->addSelect([
            'nama_jenis',
        ]);
    }
}
