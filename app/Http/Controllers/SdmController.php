<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Karyawan;
use App\Mahasiswa;
use App\Prodi;
use App\MateriBorang;
use DB;
use App\JenisJabatanFungsional;

class SdmController extends Controller
{
    public function index(Request $request)
    {
        $tahun_now = $request->input('tahun', Carbon::now()->format('Y'));
        // SKOR NILAI SDM
        $materi_sdm = MateriBorang::with([
            'nilai' => function ($query) use ($tahun_now) {
                return $query->where('tahun', $tahun_now);
            },
        ])
        ->find(1804);
        $nilai_sdm = $materi_sdm->nilai->first();
        $skor_nilai_sdm = round($nilai_sdm->nilai ? $nilai_sdm->nilai : 0, 2);
        // DATA PRODI
        $prodi = Prodi::whereIsAktif()
        ->orderByDefault()
        ->get();
        // DATA DOSEN & SERTIFIKASINYA
        $prodi_w_dosen_sertifikasi = $prodi->load(['prodi_ewmp' => function ($query) {
            return $query
            ->whereHas('karyawan', function ($query) {
                return $query
                ->whereIsAktif()
                ->whereIsDosenTetap();
            })
            ->with('karyawan.sertifikasi');
        }]);
        $dosen_tetap = $prodi_w_dosen_sertifikasi
        ->groupBy('alias')
        ->map(function ($prodi) {
            return $prodi->first()->prodi_ewmp->count();
        });
        $dosen_tetap_bersertifikasi = $prodi_w_dosen_sertifikasi
        ->groupBy('alias')
        ->map(function ($prodi) {
            return $prodi->first()->prodi_ewmp->filter(function ($prodi_ewmp) {
                return count($prodi_ewmp->karyawan->sertifikasi);
            })->count();
        });
        // DATA DOSEN & JABATAN FUNGSIONALNYA
        $prodi_w_dosen_jafung = $prodi->load(['prodi_ewmp' => function ($query) {
            return $query
            ->whereHas('karyawan', function ($query) {
                return $query
                ->whereIsDosen()
                ->whereIsAktif()
                ->whereHas('jabatan_fungsional_last', function ($query) {
                    return $query->where('id_jfa', 5);
                });
            })
            ->with('karyawan.jabatan_fungsional_last');
        }]);
        $dosen_guru_besar = $prodi_w_dosen_jafung
        ->groupBy('alias')
        ->map(function ($prodi) {
            return $prodi->first()->prodi_ewmp->count();
        });
        // RASIO DOSEN:MAHASISWA
        $jml_dosen = Karyawan::whereIsDosenTetap()
        ->count();
        $jml_mahasiswa = Mahasiswa::whereHas('histori_kuliah', function ($query) use ($tahun_now) {
            return $query
            ->where('semester', 'LIKE', Carbon::createFromFormat('Y', $tahun_now - 1)->format('y').'1')
            ->whereIsAktif();
        })
        ->count();
        $rasio_dosen_mahasiswa = round($jml_mahasiswa / $jml_dosen, 2);
        // RASIO PRODI:DOSEN
        $jml_prodi = Prodi::whereIsAktif()
        ->count();
        $rasio_prodi_dosen = round($jml_dosen / $jml_prodi, 2);
        // PRESENTASE DOSEN: TETAP TIDAK TETAP
        $jml_dosen_tetap = Karyawan::whereIsDosenTetap()
        ->count();

        return view('sdm', [
            'periode' => ($tahun_now - 1).'/'.$tahun_now,
            'prodi' => $prodi->map(function ($prodi) {
                return $prodi->id;
            })->toArray(),
            // NILAI SDM
            'skor_nilai_sdm' => $skor_nilai_sdm,
            // TENAGA KEPENDIDIKAN
            'skor_tenaga_kependidikan' => 3,
            // PRESENTASE SERTIFIKAT PENDIDIKAN
            'dosen_tetap' => $dosen_tetap->toArray(),
            'dosen_tetap_bersertifikasi' => $dosen_tetap_bersertifikasi->toArray(),
            'skor_sertifikat_pendidikan' => 3.21,
            // JABATAN FUNGSIONAL DOSEN
            'dosen_guru_besar' => $dosen_guru_besar->toArray(),
            'skor_jabatan_fungsional' => 2.00,
            // RASIO DOSEN:MAHASISWA
            'rasio_dosen_mahasiswa' => $rasio_dosen_mahasiswa,
            'skor_rasio_dosen_mahasiswa' => 4.00,
            // RASIO PRODI:DOSEN
            'rasio_prodi_dosen' => $rasio_prodi_dosen,
            'skor_rasio_prodi_dosen' => 3.26,
            // PRESENTASE DOSEN: TETAP
            'jml_dosen_tetap' => $jml_dosen_tetap,
            'jml_dosen_tidak_tetap' => 0,
            'skor_presentase_dosen_tidak_tetap' => 4,
        ]);
    }

    public function getDosenProdiSertifikasi(Request $request, $kode_prodi)
    {
        $prodi = Prodi::with(['prodi_ewmp' => function ($query) {
            return $query
            ->with([
                'karyawan.sertifikasi',
                'karyawan.pendidikan_formal_last',
            ])
            ->whereHas('karyawan', function ($query) {
                return $query
                ->whereIsAktif()
                ->whereIsDosenTetap();
            });
        }])
        ->find($kode_prodi);

        $karyawan = $prodi->prodi_ewmp
        ->map(function ($prodi_ewmp) {
            $karyawan = $prodi_ewmp->karyawan;

            return $karyawan;
        });

        $karyawan_tersertifikasi = $karyawan->filter(function ($karyawan) {
            return count($karyawan->sertifikasi);
        });

        $jenjang_studi = collect(['S1', 'S2', 'S3']);

        $data = collect([
            [
                'label' => 'Tersertifikasi',
                'data' => $jenjang_studi->map(function ($jenjang_studi) use ($karyawan_tersertifikasi) {
                    return $karyawan_tersertifikasi->filter(function ($karyawan_tersertifikasi) use ($jenjang_studi) {
                        return $karyawan_tersertifikasi->pendidikan_formal_last->jenjang_studi == $jenjang_studi;
                    })->count();
                }),
            ],
        ])->prepend([
            'label' => 'Jumlah Dosen',
            'data' => $jenjang_studi->map(function ($jenjang_studi) use ($karyawan) {
                return $karyawan->filter(function ($karyawan) use ($jenjang_studi) {
                    return $karyawan->pendidikan_formal_last->jenjang_studi == $jenjang_studi;
                })->count();
            }),
        ]);

        return [
            'nama' => $prodi->nama,
            'labels' => $jenjang_studi->toArray(),
            'datasets' => $data,
        ];
    }

    public function getDosenProdiJafung(Request $request, $kode_prodi)
    {
        $prodi = Prodi::with(['prodi_ewmp' => function ($query) {
            return $query
            ->with([
                'karyawan.jabatan_fungsional_last.jenis_jafung',
                'karyawan.pendidikan_formal_last',
            ])
            ->whereHas('karyawan', function ($query) {
                return $query
                ->whereHas('jabatan_fungsional_last')
                ->whereIsDosen()
                ->whereIsAktif();
            });
        }])
        ->find($kode_prodi);
        $karyawan = $prodi->prodi_ewmp
        ->map(function ($prodi_ewmp) {
            $karyawan = $prodi_ewmp->karyawan;

            return $karyawan;
        });
        $jabatan_fungsional = JenisJabatanFungsional::whereIn('id_jabatan', [1,2,3,4,5])
        ->orderBy('bobot_jabatan')
        ->get();

        $jenjang_studi = collect(['S1', 'S2', 'S3']);

        $data = $jenjang_studi->map(function($jenjang_studi) use ($jabatan_fungsional, $karyawan) {
            $karyawan = $karyawan->filter(function($karyawan) use ($jenjang_studi) {
                return $karyawan->pendidikan_formal_last->jenjang_studi == $jenjang_studi;
            });
            return [
                'label' => $jenjang_studi,
                'data' => $jabatan_fungsional->map(function($jabatan_fungsional) use ($karyawan) {
                    return $karyawan->filter(function($karyawan) use ($jabatan_fungsional) {
                        return $karyawan->jabatan_fungsional_last->id_jfa == $jabatan_fungsional->id_jabatan;
                    })->count();
                }),
            ];
        })
        ->prepend([
            'label' => 'Jumlah Dosen',
            'data' => $jabatan_fungsional->map(function ($jabatan_fungsional) use ($karyawan) {
                return $karyawan->filter(function ($karyawan) use ($jabatan_fungsional) {
                    return $karyawan->jabatan_fungsional_last->id_jfa == $jabatan_fungsional->id_jabatan;
                })->count();
            }),
        ]);

        return [
            'nama' => $prodi->nama,
            'labels' => $jabatan_fungsional->pluck('jabatan_fungsional')->toArray(),
            'datasets' => $data,
        ];
    }

		public function profil(){
    		$data_profil = [];

    		$nilai = 2.5;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Dosen Tetap", 
    				'link' 		=> '/sdm/profil/Dosen Tetap/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'grad', 'icon_arr' => array('width' => 50, 'height' => 50) ),
    				'data' 		=> array("Skor" => [($nilai*100/4), $nilai], "Kondisi Saat Ini" => [60, "60"], "# Dosen Tetap"=>[12, "12"]),
    			)
    		);
    		$nilai = 3.7;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Dosen S3", 
    				'link' 		=> '/sdm/profil/Dosen Tetap/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'gradbook', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data' 		=> array('Skor' => [($nilai*100/4), $nilai], 'Kondisi Saat Ini' => [100, "100"], '# Dosen S3' => [20, "20"] ),
    			)
    		);
    		$nilai = 3.5;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Lektor &#38; Guru besar", 
    				'link' 		=> '/sdm/profil/Lektor &#38; Guru besar/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart'		=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon'		=> array('name' => 'quality', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data'		=> array('Skor' => [($nilai*100/4), $nilai], 'Kondisi Saat Ini' => [40, "40"], 'LK & GB' => [40, "40"]),
				)
    		);
    		$nilai = 3.5;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Sertifikasi Dosen", 
    				'link' 		=> '/sdm/profil/Sertifikasi Dosen/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'certificate', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data' 		=> array('Skor' => [($nilai*100/4), $nilai], 'Kondisi Saat Ini' => [40, "40"], '# PSPP' => [40, "40"] ),
				)
    		);
    		$nilai = 3.6;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Rasio Mahasiswa &#38; Dosen", 
    				'link' 		=> '/sdm/profil/Rasio Mahasiswa &#38; Dosen/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'graduate', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data' 		=> array('Skor' => [($nilai*100/4), $nilai], 'Kondisi Saat Ini' => [40, "40"], 'Rasio' => [40, "40"] ),
				)
    		);
    		$nilai = 1.2;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Dosen Tidak Tetap", 
    				'link' 		=> '/sdm/profil/Dosen Tidak Tetap/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'feedback', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data' 		=> array('Skor' => [($nilai*100/4), $nilai], 'Kondisi Saat Ini' => [40, "40"], '# PDTT' => [20, "20"] ),
				)
    		);
    		$data = array('data' => $data_profil);
    		return view('sdm_profil', ['data_profil' => $data_profil]);
    	}

    public function beban_kerja(){
    	return view('sdm_beban_kerja');
    }

    public function produktivitas(){
        return view('sdm_produktivitas');
    }

    public function detail_ajax(){
        return view('sdm_detail');
    }

    public function dosen(){
        return view('sdm_dosen');
    }

    public function dosen_document(){
        return view('sdm_dosen_document');
    }

    public function dosen_detail(){
        return view('sdm_dosen_detail');
    }
	
	public function list_dosen(){
		/*$result = DB::select("select nik, nama, sex, gelar_depan, gelar_belakang, kary_type, (select jenjang_studi from V_PEND_FORMAL_KAR a where nik = kar.nik and no = (select max(no) from v_pend_formal_kar where nik = a.nik and jenjang_studi is not null)) jenjang_studi 
		from v_karyawan kar where status = 'A' and kary_type like '%D%' and kary_type <> 'AD'");
		*/
		$result = \App\Karyawan::with([
			'pendidikan_formal' => function($query){
				return $query->whereNotNull('jenjang_studi');
			},
			'berkas_portofolio',
			'jabatan_fungsional.jenis_jafung',
		])
		->whereIsAktif()
		->whereIsDosenTetap()
		->get();
		$result = $result->map(function($dosen){
			$dosen->pendidikan_formal = $dosen->pendidikan_formal
			->sortByDesc('no')
			->first();
			
			$dosen->jabatan_fungsional = $dosen->jabatan_fungsional
			->sortByDesc('mulai_tetap_tmt')
			->first();
			return $dosen;			
		});
		
		$prodi = Prodi::whereIsAktif()
        ->orderBy('id')        
        ->get();
		
		return view('list_dosen', ['result' => $result, 'prodi' => $prodi]);		
		//return view('list_dosen');
	}
	
	public function list_dosen_detail($id){
		$result = DB::connection('oracle_stikom_dev')->select("select nik, nip, nama, decode(sex, 1, 'Laki - Laki', 2, 'Perempuan') sex, decode(kary_type, 'DC', 'Dosen Percobaan', 'DH', 'Dosen Homebase', 'KD', 'Dosen Kontrak', 'TD', 'Dosen Tetap') kary_type, (select nama from v_fakultas@get_ori where id = fakul_id) prodi,
								(select jabatan_fungsional from v_jafung@get_ori where id_jabatan = (select id_jfa from v_jafung_akademik@get_ori a where id_jfa = 
									(select max(id_jfa) from v_jafung_akademik@get_ori where nik = a.nik) and nik = kar.nik
								)) jafung,
								decode((select jenjang_studi from V_PEND_FORMAL_KAR@get_ori a where nik = kar.nik and no = 
									(select max(no) from v_pend_formal_kar@get_ori where nik = a.nik and jenjang_studi is not null)
								),'S1', 'Strata 1', 'S2', 'Strata 2', 'S3', 'Strata 3') jenjang_studi
							from v_karyawan@get_ori kar where nik = '$id'");
		$akademik = DB::connection('oracle_stikom_dev')->select("select no, jenjang, nama_sekolah, jenjang_studi, substr(tahun_lulus, -4) tahun_lulus, jurusan from V_PEND_FORMAL_KAR@get_ori where nik = '$id'
										and lower(jenjang_studi) in ('s1','s2','s3') order by 1");										
		/*$penelitian = DB::connection('oracle_stikom_dev')->select("select mk, 'Institut Bisnis dan Informatika Stikom Surabaya' lembaga, substr(periode, -4) tahun from pantja.ewmp_b@get_ori where nik = '$id' and lower(mk) not like '%studi lanjut%'");*/
		
		$penelitian = DB::connection('oracle_stikom_dev')->select("select judul, jns, substr(smt,1,2) tahun, 'Institut Bisnis dan Informatika Stikom Surabaya' lembaga from pantja.ewmp_b_dashboard@get_ori where nik = '$id' order by tahun");
		
		/*$riwayat = DB::select("select substr(smt,1,2) tahun, sum(b.sks) sks from jdwkul_mf_his a join kurlkl_mf b on a.klkl_id = b.id where a.prodi = b.fakul_id and kary_nik = '$id' group by substr(smt,1,2) order by 1");*/
		
		$riwayat = DB::connection('oracle_stikom_dev')->select("select substr(a.semester,1,2) tahun, sum(b.sks) sks from rekap_mf@get_ori a join kurlkl_mf@get_ori b on a.jkul_klkl_id = b.id where a.prodi = b.fakul_id and jkul_kary_nik = '$id' and sts_dosen = '*' and substr(a.semester, 1,1) <> '9' group by substr(a.semester,1,2) order by 1");
		
		return view('list_dosen_detail', ['result' => $result, 'akademik' => $akademik, 'penelitian' => $penelitian, 'line' => $riwayat]);
	}
	
	public function list_dosen_filter($id){
		/*$result = DB::select("select nik, nama, sex, gelar_depan, gelar_belakang, kary_type, (select jenjang_studi from V_PEND_FORMAL_KAR a where nik = kar.nik and no = (select max(no) from v_pend_formal_kar where nik = a.nik and jenjang_studi is not null)) jenjang_studi 
		from v_karyawan kar where status = 'A' and kary_type like '%D%' and kary_type <> 'AD'");
		*/
		
		$result = \App\Karyawan::with([
			'pendidikan_formal' => function($query){
				return $query->whereNotNull('jenjang_studi');
			},
			'berkas_portofolio',
			'jabatan_fungsional.jenis_jafung',
		])
		->whereIsAktif()
		->whereIsDosenTetap()
		->where('fakul_id',$id)
		->get();
		$result = $result->map(function($dosen){
			$dosen->pendidikan_formal = $dosen->pendidikan_formal
			->sortByDesc('no')
			->first();
			
			$dosen->jabatan_fungsional = $dosen->jabatan_fungsional
			->sortByDesc('id_jfa')
			->first();
			return $dosen;			
		});
		
		$prodi = Prodi::whereIsAktif()
        ->orderBy('id')        
        ->get();
		
		return view('list_dosen_filter', ['result' => $result, 'prodi' => $prodi]);		
		//return view('list_dosen_filter');
	}
}
