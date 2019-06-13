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
				'sex',
            ])
            ->leftJoin('v_email_kar', 'v_karyawan.nik', 'v_email_kar.nik')
            ->addSelect([
                'v_email_kar.email',
            ]);
    }

    public function pendidikan_formal()
    {
        return $this->hasMany(PendidikanFormal::class, 'nik');
    }

    public function berkas_portofolio()
    {
        return $this->hasMany(BerkasPortofolio::class, 'nik');
    }

    public function scopeWhereIsAktif($query)
    {
        return $query->where('status', 'A');
    }

    public function scopeWhereIsDosen($query)
    {
        return $query->where(function ($query_) {
            return $query_
            ->where('kary_type', 'LIKE', '%D%')
            ->orWhere('kary_type', 'LB');
        })
        ->where('kary_type', '!=', 'AD');
    }

    public function scopeWhereIsDosenTetap($query)
    {
        return $query->whereisDosen()
        ->whereIsAktif()
        ->where('kary_type', '!=', 'LB')
        ->where(\DB::Raw('length(v_karyawan.nik)'), 6);
    }

    public function scopeWhereIsDosenTidakTetap($query)
    {
        return $query->whereIsDosen()
        ->whereIsAktif()
        ->where(\DB::Raw('length(v_karyawan.nik)'), 3);
    }

    public function prodi_ewmp()
    {
        return $this->hasMany(ProdiEwmp::class, 'nik');
    }

    public function sertifikasi()
    {
        return $this->hasMany(SertifikasiKaryawan::class, 'nik');
    }

    public function jabatan_fungsional()
    {
        return $this->hasMany(JabatanFungsional::class, 'nik');
    }

    public function histori_ajar()
    {
        return $this->hasMany(HistoriAjar::class, 'kary_nik');
    }

    public function getSumHistoriSksAttribute()
    {
        return $this->histori_ajar->sum('sks');
    }
}
