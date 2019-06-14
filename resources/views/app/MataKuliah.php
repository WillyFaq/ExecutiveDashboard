<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'kurlkl_mf';
    protected $primaryKey = 'id';
    public $casts = ['id' => 'string'];

    public function scopeWhereIsAktif($query)
    {
        return $query->where('status', '>', 0);
    }
}
