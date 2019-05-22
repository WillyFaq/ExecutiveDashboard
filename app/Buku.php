<?php

namespace App;

class Buku extends RekapEwmp
{
    public function newQuery()
    {
        return parent::newQuery()
            ->whereIsBuku();
    }
}
