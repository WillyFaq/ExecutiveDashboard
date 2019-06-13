<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'v_karyawan';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $casts = [
        'nik' => 'string',
        'nip' => 'string',
        'nidk' => 'string',
        'nup' => 'string',
    ];

    public function newQuery()
    {
        return parent::newQuery()
            ->addSelect([
                'v_karyawan.nik',
                'nip',
                'nidk',
                'nup',
                'nama',
				'gelar_depan',
				'gelar_belakang',
				'kary_type',
            ])
            ->leftJoin('v_email_kar', 'v_karyawan.nik', 'v_email_kar.nik')
            ->addSelect([
                'v_email_kar.email',
            ])
            ->leftJoin('v_prodiewmp', 'v_karyawan.nik', 'v_prodiewmp.nik')
            ->addSelect(['v_prodiewmp.prodi']);
    }
	
	public function pendidikan_formal() {
		return $this->hasMany(PendidikanFormal::class,'nik');
	}
	
	public function berkas_portofolio(){
		return $this->hasMany(BerkasPortofolio::class,'nik');
	}

    public function scopeWhereIsAktif($query)
    {
        return $query->where('status', 'A');
    }

    public function scopeWhereIsDosen($query)
    {
        return $query->where(function ($query_) {
            return $query_->where('kary_type', 'LIKE', '%D%')
                ->orWhere('kary_type', 'LIKE', 'LB');
        });
    }

    public function scopeWhereIsDosenTetap($query)
    {
        return $query->where('kary_type', 'TD')
            ->where('kary_type', '!=', 'LB');
    }

    public function scopeWhereIsDosenTidakTetap($query)
    {
        return $query->whereIsDosen()
            ->where('kary_type', '!=', 'TD');
    }
}
