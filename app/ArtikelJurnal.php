<?php

namespace App;

class ArtikelJurnal extends RekapEwmp
{
    public function newQuery()
    {
        return parent::newQuery()
            ->whereIsArtikelJurnal();
    }
}
