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

    public function pendidikan_formal_last()
    {
        return $this->hasOne(PendidikanFormal::class, 'nik')
        ->latest(\DB::Raw("CASE jenjang_studi WHEN 'S1' THEN 1 WHEN 'S2' THEN 2 WHEN 'S3' THEN 3 ELSE 0 END"));
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
        ->whereNotIn('kary_type', ['LB', 'DP'])
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
        return $this->hasMany(SertifikasiDosen::class, 'nik');
    }

    public function jabatan_fungsional()
    {
        return $this->hasMany(JabatanFungsional::class, 'nik');
    }

    public function jabatan_fungsional_last()
    {
        return $this->hasOne(JabatanFungsional::class, 'nik')
        ->latest('mulai_tetap_tmt')
        ->withDefault(function ($jabatan_fungsional_last) {
            $jabatan_fungsional_last->id_jfa = 1;
        });
    }

    public function histori_ajar()
    {
        return $this->hasMany(HistoriAjar::class, 'kary_nik');
    }

    public function getSumHistoriSksAttribute()
    {
        return $this->histori_ajar->sum('sks');
    }

    public function getJenisKelaminAttribute()
    {
        if (1 == $this->attributes['sex']) {
            return 'Laki-laki';
        }

        return   'Perempuan';
    }

    public function getNamaJabatanFungsionalLastAttribute()
    {
        if (null == $this->relations['jabatan_fungsional_last']) {
            return 'Tenaga Pengajar';
        }

        return $this->relations['jabatan_fungsional_last']->jenis_jafung->jabatan_fungsional;
    }

    public function getJenjangStudiLastAttribute()
    {
        switch ($this->relations['pendidikan_formal_last']->jenjang_studi) {
            case 'S1': return 'Strata 1';
            case 'S2': return 'Strata 2';
            case 'S3': return 'Strata 3';
            default: return $this->relations['pendidikan_formal_last']->jenjang_studi;
        }
    }

    public function getJenisDosenAttribute()
    {
        switch ($this->attribute['kary_type']) {
            case 'DC': return 'Dosen Percobaan';
            case 'DH': return 'Dosen Homebase';
            case 'KD': return 'Dosen Kontrak';
            case 'TD': return 'Dosen Tetap';
            default: return  '-';
        }
    }
}
