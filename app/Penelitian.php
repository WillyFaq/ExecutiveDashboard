<?php

namespace App;

class Penelitian extends RekapEwmp
{
    public function newQuery()
    {
        return parent::newQuery()
            ->whereIsPenelitian();
    }
}
