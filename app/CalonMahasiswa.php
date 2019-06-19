<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonMahasiswa extends Model
{
    protected $table = 'v_cln_mhs';
    protected $primaryKey = 'no_test';

    public function scopeWhereIsSiapOnline($query)
    {
        return $query->where(\DB::Raw('SUBSTR(no_form,3,2)'), '24');
    }
}
