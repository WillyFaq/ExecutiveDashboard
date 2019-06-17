<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'v_smt';

    public function newQuery()
    {
        return parent::newQuery()
            ->addSelect([
                \DB::Raw(<<<SQL
CASE
    WHEN SYSDATE <= (SELECT tgl_berlaku
                       FROM no_sr_ktr
                      WHERE kd_sr LIKE 'TGL_MPW1')
        THEN smt_aktif
    ELSE smt_yad
END AS semester
SQL
                ),
                'fak_id',
            ]);
    }
}
