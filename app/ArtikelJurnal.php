<?php

namespace App;

class ArtikelJurnal extends RekapEwmp
{
    public function newQuery()
    {
        return parent::newQuery()
            ->where('jenis', 2)
            ->where('bidang', 'B');
    }
}
