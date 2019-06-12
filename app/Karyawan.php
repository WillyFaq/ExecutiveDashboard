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
        'nidn' => 'string',
        'nidk' => 'string',
        'nup' => 'string',
    ];
    protected $appends = ['sum_histori_sks'];

    public function newQuery()
    {
        return parent::newQuery()
            ->addSelect([
                'v_karyawan.nik',
                \DB::Raw('nip nidn'),
                'nidk',
                'nup',
                \DB::Raw('nama_plus_gelar(v_karyawan.nik) AS NAMA'),
            ])
            ->leftJoin('v_email_kar', 'v_karyawan.nik', 'v_email_kar.nik')
            ->addSelect([
                'v_email_kar.email',
            ])
            ->leftJoin('v_prodiewmp', 'v_karyawan.nik', 'v_prodiewmp.nik')
            ->addSelect([
                \DB::Raw('v_prodiewmp.prodi AS kode_prodi'),
            ]);
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

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'kode_prodi');
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
