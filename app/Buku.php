<?php

namespace App;

class Buku extends RekapEwmp
{
    public function newQuery()
    {
        return parent::newQuery()
            ->where('jenis', 3)
            ->where('bidang', 'B');
    }
}
