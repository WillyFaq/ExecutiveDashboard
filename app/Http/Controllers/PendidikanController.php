<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prodi;

class PendidikanController extends Controller
{
    public function index(Request $request)
    {
        $prodi = collect([
            [
                'kode' => 41010,
                'nama' => 'S1 Sistem Informasi',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Project Manager',
                    'Software Engineer',
                    'IT Auditor',
                    'Programmer',
                    'Consultant Programmer',
                ],
            ], [
                'kode' => 41020,
                'nama' => 'S1 Teknik Komputer',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Computer System Engineering',
                    'Network Engineer',
                    'Computer Control Engineer',
                ],
            ], [
                'kode' => 42010,
                'nama' => 'S1 Desain Komunikasi Visual',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Creative Director',
                    'Art Director',
                    'Media Planner',
                    'Copywriter',
                ],
            ], [
                'kode' => 42020,
                'nama' => 'S1 Desain Produk',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Creative Director',
                    'Art Director',
                    'Media Planner',
                    'Copywriter',
                    'Product Design Consultant',
                ],
            ], [
                'kode' => 51016,
                'nama' => 'D4 Produksi Film & Television',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Broadcaster',
                    'Animator',
                    'Ilustrator',
                ],
            ], [
                'kode' => 39010,
                'nama' => 'D3 Sistem Informasi',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Programmer',
                    'Web Programmer',
                    'Technopreneurship',
                    'System Analyst',
                ],
            ], [
                'kode' => 43020,
                'nama' => 'S1 Akutansi',
                'fakultas' => 'Fakultas Ekonomi Bisnis',
                'profil' => [
                    'Auditor',
                    'Management Accountant',
                    'Accounting Information System Consultant',
                ],
            ], [
                'kode' => 43010,
                'nama' => 'S1 Manajemen',
                'fakultas' => 'Fakultas Ekonomi Bisnis',
                'profil' => [
                    'Bussiness Owner',
                    'Manage',
                    'Professioal Accountant',
                ],
            ], [
                'kode' => 39015,
                'nama' => 'D3 Administrasi Perkantoran',
                'fakultas' => 'Fakultas Ekonomi Bisnis',
                'profil' => [
                    'Executive Secretary',
                    'Personal Assitant',
                    'Public Relation',
                    'Export Import & Business',
                ],
            ],
        ]);

        return view('pendidikan', [
            'prodi' => $prodi->toArray(),
        ]);
    }

    public function detail(Request $request, $kode_prodi)
    {
        $prodi = Prodi::whereIsAktif()
        ->with([
            'fakultas',
            'mata_kuliah' => function ($query) {
                return $query->whereIsAktif();
            },
        ])
        ->find($kode_prodi);
        $prodi->web = 'si.stikom.edu';

        $mata_kuliah = $prodi->mata_kuliah
        ->sortBy('id')
        ->sortBy('semester')
        ->groupBy('semester');

        $data_rps = \DB::select("SELECT   k.fakul_id
        ,k.jenis
        --,COUNT(k.ID)
        ,SUM(sks) sks
    FROM kurlkl_mf k
        ,fak_mf f
   WHERE k.fakul_id = f.ID
         AND f.sts_aktif = 'Y'
         AND f.ID NOT IN('41011', '39090')
         AND k.status <> '0'
         AND k.jenis BETWEEN 1 AND 5
         AND f.id = :id_prodi
GROUP BY k.fakul_id
        ,k.jenis
ORDER BY k.fakul_id
        ,k.jenis", [
            'id_prodi' => $kode_prodi,
        ]);
        $data_rps = array_map(function ($rps) {
            return $rps->sks;
        }, $data_rps);

        return view('pendidikan_detail', [
            'prodi' => $prodi->toArray(),
            'mata_kuliah' => $mata_kuliah->toArray(),
            'data_rps' => $data_rps,
        ]);
    }
}
