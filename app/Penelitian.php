<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    protected $table = 'pantja.ewmp_b_dashboard';

    public function getLembagaAttribute()
    {
        return isset($this->attributes['lembaga']) ?
        $this->attributes['lembaga'] :
        'Institut Bisnis dan Informatika Stikom Surabaya';
    }
}
