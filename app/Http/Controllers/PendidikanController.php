<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function index(Request $request)
    {
        $prodi = collect([
            [
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
                'nama' => 'S1 Teknik Komputer',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Computer System Engineering',
                    'Network Engineer',
                    'Computer Control Engineer',
                ],
            ], [
                'nama' => 'S1 Desain Komunikasi Visual',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Creative Director',
                    'Art Director',
                    'Media Planner',
                    'Copywriter',
                ],
            ], [
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
                'nama' => 'S1 Produksi Film & Television',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Broadcaster',
                    'Animator',
                    'Ilustrator',
                ],
            ], [
                'nama' => 'D3 Sistem Informasi',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Programmer',
                    'Web Programmer',
                    'Technopreneurship',
                    'System Analyst',
                ],
            ], [
                'nama' => 'S1 Akutansi',
                'fakultas' => 'Fakultas Ekonomi Bisnis',
                'profil' => [
                    'Auditor',
                    'Management Accountant',
                    'Accounting Information System Consultant',
                ],
            ], [
                'nama' => 'S1 Manajemen',
                'fakultas' => 'Fakultas Ekonomi Bisnis',
                'profil' => [
                    'Bussiness Owner',
                    'Manage',
                    'Professioal Accountant',
                ],
            ], [
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
}
