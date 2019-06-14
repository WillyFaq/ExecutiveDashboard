<?php

namespace App;

class Kepanitiaan extends RekapEwmp
{
    public function newQuery()
    {
        return parent::newQuery()
            ->whereIsKepanitiaan();
    }
}
