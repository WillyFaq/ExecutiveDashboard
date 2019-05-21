<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembinaUnitKegiatanMahasiswa extends Model
{
    protected $table = 'v_pmb_ukm';

    public function newQuery()
    {
        return parent::newQuery()
        ->addSelect([
            \DB::Raw('substr(p.nosk,-4,4) tahun'),
            'nosk',
            'nama_ukm',
            'sie',
        ]);
    }
}
