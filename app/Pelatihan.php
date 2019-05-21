<?php

namespace App;

class Pelatihan extends RekapEwmp
{
    public function newQuery()
    {
        return parent::newQuery()
            ->where('bidang', 'C');
    }
}
