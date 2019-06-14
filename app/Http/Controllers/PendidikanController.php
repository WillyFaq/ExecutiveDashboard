<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prodi;
use App\MataKuliah;

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
                'gdrive'=> 'https://drive.google.com/drive/folders/0B_81wNH_zonXZE1VeElZSzNWTXM?usp=sharing',
            ], [
                'kode' => 41020,
                'nama' => 'S1 Teknik Komputer',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Computer System Engineering',
                    'Network Engineer',
                    'Computer Control Engineer',
                ],
                'gdrive'=> 'https://drive.google.com/drive/folders/0B_81wNH_zonXMWF4UmNDdFVLWTQ?usp=sharing',
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
                'gdrive'=> 'https://drive.google.com/drive/folders/0B_81wNH_zonXQi00REo3V0tlLXc?usp=sharing',
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
                'gdrive'=> 'https://drive.google.com/drive/folders/0B_81wNH_zonXNS11VzhFWmlQLWc?usp=sharing',
            ], [
                'kode' => 51016,
                'nama' => 'D4 Produksi Film & Television',
                'fakultas' => 'Fakultas Teknologi Informasi',
                'profil' => [
                    'Broadcaster',
                    'Animator',
                    'Ilustrator',
                ],
                'gdrive'=> 'https://drive.google.com/drive/folders/0B_81wNH_zonXQ0ZzM1hRQ0dJQ28?usp=sharing',
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
                'gdrive'=> 'https://drive.google.com/drive/folders/0B_81wNH_zonXMDhpaWoxZ0pZclk?usp=sharing',
            
            ], [
                'kode' => 43020,
                'nama' => 'S1 Akutansi',
                'fakultas' => 'Fakultas Ekonomi Bisnis',
                'profil' => [
                    'Auditor',
                    'Management Accountant',
                    'Accounting Information System Consultant',
                ],
                'gdrive'=> 'https://drive.google.com/drive/folders/0B_81wNH_zonXSktmVEZUbHJ1STg?usp=sharing',
            
            ], [
                'kode' => 43010,
                'nama' => 'S1 Manajemen',
                'fakultas' => 'Fakultas Ekonomi Bisnis',
                'profil' => [
                    'Bussiness Owner',
                    'Manage',
                    'Professioal Accountant',
                ],
                'gdrive'=> 'https://drive.google.com/drive/folders/0B_81wNH_zonXRVNjdXlKWXN1OUE?usp=sharing',
            
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
                'gdrive'=> 'https://drive.google.com/drive/folders/0B_81wNH_zonXQ1JERzhwcllKdXc?usp=sharing',
            ],
        ]);

        return view('pendidikan', [
            'prodi' => $prodi->toArray(),
        ]);
    }

    public function detail(Request $request, $kode_prodi)
    {
        $gdrive['41010']='https://drive.google.com/drive/folders/0B_81wNH_zonXZE1VeElZSzNWTXM?usp=sharing';
        $web['41010']='si.stikom.edu';
        $gdrive['41020']='https://drive.google.com/drive/folders/0B_81wNH_zonXMWF4UmNDdFVLWTQ?usp=sharing';
        $web['41020']='sk.stikom.edu';
        $gdrive['42010']='https://drive.google.com/drive/folders/0B_81wNH_zonXQi00REo3V0tlLXc?usp=sharing';
        $web['42010']='dkv.stikom.edu';
        $gdrive['42020']='https://drive.google.com/drive/folders/0B_81wNH_zonXNS11VzhFWmlQLWc?usp=sharing';
        $web['42020']='dg.stikom.edu';
        $gdrive['51016']='https://drive.google.com/drive/folders/0B_81wNH_zonXQ0ZzM1hRQ0dJQ28?usp=sharing';
        $web['51016']='mm.stikom.edu';
        $gdrive['39010']='https://drive.google.com/drive/folders/0B_81wNH_zonXMDhpaWoxZ0pZclk?usp=sharing';
        $web['39010']='mi.stikom.edu';
        $gdrive['43020']='https://drive.google.com/drive/folders/0B_81wNH_zonXSktmVEZUbHJ1STg?usp=sharing';
        $web['43020']='akuntansi.stikom.edu';
        $gdrive['43010']='https://drive.google.com/drive/folders/0B_81wNH_zonXRVNjdXlKWXN1OUE?usp=sharing';
        $web['43010']='manajemen.stikom.edu';
        $gdrive['39015']='https://drive.google.com/drive/folders/0B_81wNH_zonXQ1JERzhwcllKdXc?usp=sharing';
        $web['39015']='kpk.stikom.edu';
        $prodi = Prodi::whereIsAktif()
        ->with([
            'fakultas',
            'mata_kuliah' => function ($query) {
                return $query->whereIsAktif();
            },
        ])
        ->find($kode_prodi);
        $prodi->web =  $web[$kode_prodi];
        $prodi->gdrive = $gdrive[$kode_prodi];
        switch(substr($prodi->id,0,1)){
        case 3:
            $prodi->nama = 'D3 '.$prodi->nama;
            break;
        case 4:
            $prodi->nama = 'S1 '.$prodi->nama;
            break;
        case 5:
            $prodi->nama = 'D4 '.$prodi->nama;
            break;
        }
        $mata_kuliah = $prodi->mata_kuliah
        ->map(function ($mata_kuliah) use ($kode_prodi) {
            $mata_kuliah->prasyarat = MataKuliah::whereIn('id', array_map(function($kode_mk){
                return trim($kode_mk);
            }, str_split($mata_kuliah->prasyarat, 10)))
            ->where('fakul_id', $kode_prodi)
            ->get()
            ->unique();

            if (11 == substr($mata_kuliah->id, 0, 2)) {
                $mata_kuliah->nama = 'Pendidikan Agama';
                $mata_kuliah->id = substr($mata_kuliah->id, 0, 2).'XXX';
            }

            if (8 == $mata_kuliah->jenis) {
                $mata_kuliah->nama = 'Mata Kuliah Pilihan';
                $mata_kuliah->id = substr($mata_kuliah->id, 0, 1).'XXXX';
                switch ($mata_kuliah->prodi) {
                case '41010':
                    switch ($mata_kuliah->semester) {
                    case '6':
                        $mata_kuliah->sks = 6;
                        break;
                    case '7':
                        $mata_kuliah->sks = 6;
                        break;
                    }
                    break;
                case '41020':
                    switch ($mata_kuliah->semester) {
                    case '7':
                        $mata_kuliah->sks = 6;
                        break;
                    case '8':
                        $mata_kuliah->sks = 3;
                        break;
                    }
                    break;
                case '42020':
                    switch ($mata_kuliah->semester) {
                    case '4':
                        $mata_kuliah->sks = 6;
                        break;
                    case '5':
                        $mata_kuliah->sks = 3;
                        break;
                    case '6':
                        $mata_kuliah->sks = 3;
                        break;
                    }
                    break;
                case '42010':
                    switch ($mata_kuliah->semester) {
                    case '4':
                        $mata_kuliah->sks = 3;
                        break;
                    case '5':
                        $mata_kuliah->sks = 3;
                        break;
                    case '6':
                        $mata_kuliah->sks = 3;
                        break;
                    case '7':
                        $mata_kuliah->sks = 3;
                        break;
                    }
                    break;
                }
            }

            return $mata_kuliah;
        })
        ->reject(function($mata_kuliah){
            switch($mata_kuliah->fakul_id) {
                case '51016':
                    return in_array($mata_kuliah->id, [
                        '36174', '36218', '36216',
                        '32009', '36217', '32001',
                    ]);
                case '43020':
                    return in_array(substr($mata_kuliah->id,-5), [
                        '36020', '36037', '36032',
                        '36053', '36062', '36067',
                        '36030', '36039',
                    ]);
                case '43010':
                    return in_array(substr($mata_kuliah->id,-5), [
                        '36061', '36090', '36096',
                        '36055', '36056', '36063',
                        '36040', '36057', '36073',
                        '36098', '36099', '36100',
                    ]);
            }
            return false;
        })
        ->unique()
        ->sortBy('id')
        ->sortBy('semester')
        ->groupBy('semester');

        $data_domain = collect(\DB::select("
SELECT domain
      ,persen
  FROM domain_kurkl
 WHERE prodi = :prodi
", [
            'prodi' => $kode_prodi,
        ]))
        ->map(function($domain){
            return (array) $domain;
        });

        return view('pendidikan_detail', [
            'prodi' => $prodi->toArray(),
            'mata_kuliah' => $mata_kuliah->toArray(),
            'data_domain' => $data_domain->toArray(),
        ]);
    }
}
