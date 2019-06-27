<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    protected $table = 'pantja.ewmp_b';

    public function newQuery()
    {
        return parent::newQuery()
        ->where('mk', '<>', 'Studi Lanjut');
    }
}
