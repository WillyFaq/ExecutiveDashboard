<?php

namespace App;

class HibahPengabdian extends RekapEwmp
{
    public function newQuery()
    {
        return parent::newQuery()
            ->where('bidang', 'C');
    }
}
