<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriKuliah extends Model
{
    protected $table = 'v_his_kul';

    public function newQuery()
    {
        return parent::newQuery()
            ->addSelect([
                'v_his_kul.mhs_nim',
                'v_his_kul.semester',
            ]);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_nim');
    }
}
