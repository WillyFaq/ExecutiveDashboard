<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'v_fakul';
    protected $primarykey = 'id';

    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'id_fakultas');
    }
}
