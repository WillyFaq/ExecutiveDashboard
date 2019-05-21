<?php

namespace App;

class Penelitian extends RekapEwmp
{
    public function newQuery()
    {
        return parent::newQuery()
            ->where('jenis', 1)
            ->where('bidang', 'B');
    }
}
