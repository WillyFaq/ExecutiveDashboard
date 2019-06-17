<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenilaianKinerja extends Model
{
    protected $table = 'v_karyawan';

    public function newQuery()
    {
        return parent::newQuery()
            ->join(\DB::Raw(<<<SQL
(SELECT * 
  FROM (
    SELECT nik
          ,al_nilai
          ,atl_nilai
          ,ROUND(CASE
               WHEN atl_nilai IS NULL
                   THEN al_nilai
               ELSE (atl_nilai * 0.4) +(al_nilai * 0.6)
           END,2) nilai
           ,id_periode
      FROM (
        SELECT nik
              ,nilai_akhir
              ,CASE
                   WHEN penilai_so = so.atasan_tidak_langsung
                       THEN 'ATL'
                   ELSE 'AL'
               END penilai
              ,id_periode
          FROM v_nilai_akhir_kinerja nilai 
               LEFT JOIN v_so_penilaian so ON nilai.nik_so = so.id_so
      ) PIVOT (
        AVG(nilai_akhir) AS nilai FOR (penilai) IN ('ATL' AS ATL, 'AL' AS AL)
      )
  ) nilai
       JOIN
       v_kualitas
       ON(CASE
              WHEN nilai <= 2.99
                  THEN 3
              WHEN nilai <= 4.99
                  THEN 5
              WHEN nilai <= 6.99
                  THEN 7
              WHEN nilai <= 8.99
                  THEN 9
              ELSE 10
          END) = batas_atas
       JOIN v_periode_kerja periode ON nilai.id_periode = periode.id_periode)
penilaian_kinerja
SQL
            ), 'v_karyawan.nik', 'penilaian_kinerja.nik');
    }
}
