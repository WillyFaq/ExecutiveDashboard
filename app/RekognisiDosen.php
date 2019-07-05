<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekognisiDosen extends Model
{
    protected $table = 'pantja.ewmp_tgs';
    protected $casts = [
        'mulai' => 'date',
        'selesai' => 'date',
    ];

    public function newQuery()
    {
        return parent::newQuery()
        ->addSelect([
            'bidang',
            'nik',
            'no_surat',
            \DB::Raw("TO_CHAR(mulai,'YYYY-MM-DD HH24:MI:SS') AS mulai"),
            \DB::Raw("TO_CHAR(selesai,'YYYY-MM-DD HH24:MI:SS') AS selesai"),
            'status',
            'kegiatan',
            'durasi',
            'beban',
            'sts_ewmp',
        ])
        ->whereIn(\DB::Raw('UPPER(TRIM(status))'), [
            'NARASUMBER',
            'PEMBICARA',
            'ASSESSOR',
            'INSTRUKTUR',
            'JURI',
        ]);
    }
}
