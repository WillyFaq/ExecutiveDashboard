<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekapEwmp extends Model
{
    const TAHUN_AWAL = 11;

    protected $table = 'rekap_ewmp_lain_pc_prodi';

    /**
     * Untuk men-set semester yang digunakan ketika select tabel ini.
     *
     * Tabel ini agak "unik" karena jika hanya select saja akan menampilkan sebagian data.
     * Sebelum select perlu di-set semester nya.
     * Setelah itu hasil select akan menampilkan data pada semester tersebut.
     *
     * Misal untuk select data semester 182:
     * RekapEwmp::setSemester('182');
     * $data = RekapEwmp::get();
     * 
     * Misal untuk mengambil semua data:
     * $data = collect();
     * for($tahun = RekapEwmp::TAHUN_AWAL; $tahun <= $tahun_smt_saat_ini; $tahun++) {
     *     for($semester = 1; $semester <= 2; $semester++) {
     *         RekapEwmp::setSemester($tahun.$semester);
     *         collect(RekapEwmp::get());
     *     }
     * }
     *
     * @param string $semester
     */
    public static function setSemester($semester)
    {
        $sql_query = <<<SQL
BEGIN pkg_param.set_smt(:semester); END;
SQL;
        $stmt = \DB::getPdo()->prepare($sql_query);
        $stmt->bindValue('semester', $semester);
        $stmt->execute();
    }

    public function scopeWhereIsPenelitian($query)
    {
        return $query
            ->where('jenis', 1)
            ->where('bidang', 'B');
    }

    public function scopeWhereIsArtikelJurnal($query)
    {
        return $query
            ->where('jenis', 2)
            ->where('bidang', 'B');
    }

    public function scopeWhereIsBuku($query)
    {
        return $query
            ->where('jenis', 3)
            ->where('bidang', 'B');
    }

    public function scopeWhereIsHibahPengabdian($query)
    {
        return $query->where('bidang', 'C');
    }

    public function scopeWhereIsPelatihan($query)
    {
        return $query->where('bidang', 'C');
    }

    public function scopeWhereIsKepanitiaan($query)
    {
        return $query->where('bidang', 'D');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nik');
    }
}
