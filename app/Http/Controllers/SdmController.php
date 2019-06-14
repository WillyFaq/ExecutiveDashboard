<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Karyawan;
use App\Mahasiswa;
use App\Prodi;
use App\MateriBorang;
use DB;

class SdmController extends Controller
{
    public function index(Request $request)
    {
        $tahun_now = $request->input('tahun', Carbon::now()->format('Y'));
        // SKOR NILAI SDM
        $materi_sdm = MateriBorang::with([
            'nilai' => function ($query) use ($tahun_now) {
                return $query->where('tahun', $tahun_now);
            }
        ])
        ->find(1804);
        $nilai_sdm = $materi_sdm->nilai->first();
        $skor_nilai_sdm = round($nilai_sdm->nilai ? $nilai_sdm->nilai : 0,2);
        // DATA DOSEN & SERTIFIKASINYA
        $prodi = Prodi::whereIsAktif()
        ->orderBy('id')
        ->with(['prodi_ewmp' => function ($query) {
            return $query
            ->whereHas('karyawan', function ($query) {
                return $query
                ->whereIsAktif()
                ->whereIsDosenTetap();
            })
            ->with('karyawan.sertifikasi');
        }])
        ->get();
        $dosen_tetap = $prodi
        ->groupBy('alias')
        ->map(function ($prodi) {
            return $prodi->first()->prodi_ewmp->count();
        });
        $dosen_tetap_bersertifikasi = $prodi
        ->map(function ($prodi) {
            $prodi->prodi_ewmp = $prodi->prodi_ewmp->filter(function ($prodi_ewmp) {
                return count($prodi_ewmp->karyawan->sertifikasi);
            });

            return $prodi;
        })
        ->groupBy('alias')
        ->map(function ($prodi) {
            return $prodi->first()->prodi_ewmp->count();
        });
        $prodi = Prodi::whereIsAktif()
        ->orderBy('id')
        ->with(['prodi_ewmp' => function ($query) {
            return $query
            ->with('karyawan.jabatan_fungsional')
            ->whereHas('karyawan', function ($query) {
                return $query
                ->whereIsDosen()
                ->whereIsAktif()
                ->wherehas('jabatan_fungsional', function ($query) {
                    return $query->whereIn('id_jfa', [4, 5]);
                });
            });
        }])
        ->get();
        $dosen_lektor_kepala = $prodi->map(function ($prodi) {
            $prodi->prodi_ewmp = $prodi->prodi_ewmp->filter(function ($prodi_ewmp) {
                return $prodi_ewmp->karyawan->jabatan_fungsional
                ->filter(function ($jabatan_fungsional) {
                    return 4 == $jabatan_fungsional->id_jfa;
                })
                ->count();
            });

            return $prodi;
        })
        ->groupBy('alias')
        ->map(function ($prodi) {
            return $prodi->first()->prodi_ewmp->count();
        });
        $dosen_guru_besar = $prodi->map(function ($prodi) {
            $prodi->prodi_ewmp = $prodi->prodi_ewmp->filter(function ($prodi_ewmp) {
                return $prodi_ewmp->karyawan->jabatan_fungsional
                ->filter(function ($jabatan_fungsional) {
                    return 5 == $jabatan_fungsional->id_jfa;
                })
                ->count();
            });

            return $prodi;
        })
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
            // NILAI SDM
            'skor_nilai_sdm' => $skor_nilai_sdm,
            // TENAGA KEPENDIDIKAN
            'skor_tenaga_kependidikan' => 3,
            // PRESENTASE SERTIFIKAT PENDIDIKAN
            'dosen_tetap' => $dosen_tetap->toArray(),
            'dosen_tetap_bersertifikasi' => $dosen_tetap_bersertifikasi->toArray(),
            'skor_sertifikat_pendidikan' => 3.21,
            // JABATAN FUNGSIONAL DOSEN
            'dosen_lektor_kepala' => $dosen_lektor_kepala->toArray(),
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

    public function detail($judul="", $nilai=""){
    		$line = array(
    					'2011' => 1.4,
						'2012' => 1.2,
						'2013' => 2.6,
						'2014' => 3.7,
						'2015' => 2.8,
						'2016' => 3.2,
						'2017' => 3.6,
						'2018' => 3.1);
    		$bar = array(
    					'SI' => 3.4,
    					'SK' => 3.2,
    					'DKV' => 3.3,
    					'D3 SI' => 2.7,
    					'Profiti' => 3.0,
    					'Desgraf' => 1.7,
    					'Manajemen' => 2.4,
    					'Akuntansi' => 2.6,
    					'KPK' => 2.7
    					);
    		if($judul=="Lektor & Guru besar"){
    			$line = array(
    					'2011' => array("Lektor" => 2.0, "Guru Besar" => 2.3),
    					'2012' => array("Lektor" => 2.1, "Guru Besar" => 2.4),
    					'2013' => array("Lektor" => 2.2, "Guru Besar" => 2.5),
    					'2014' => array("Lektor" => 2.3, "Guru Besar" => 2.7),
    					'2015' => array("Lektor" => 2.7, "Guru Besar" => 2.6),
    					'2016' => array("Lektor" => 2.1, "Guru Besar" => 2.8),
    					'2017' => array("Lektor" => 3.6, "Guru Besar" => 3.7),
    					'2018' => array("Lektor" => 3.7, "Guru Besar" => 3.8),
    					);
    			$bar = array(
    					'SI' => array("Lektor" => 2.0, "Guru Besar" => 2.3),
    					'SK' => array("Lektor" => 2.1, "Guru Besar" => 2.4),
    					'DKV' => array("Lektor" => 2.2, "Guru Besar" => 2.5),
    					'D3 SI' => array("Lektor" => 2.3, "Guru Besar" => 2.7),
    					'Profiti' => array("Lektor" => 2.7, "Guru Besar" => 2.6),
    					'Desgraf' => array("Lektor" => 2.1, "Guru Besar" => 2.8),
    					'Manajemen' => array("Lektor" => 3.6, "Guru Besar" => 3.7),
    					'Akuntansi' => array("Lektor" => 3.7, "Guru Besar" => 3.8),
    					'KPK' => array("Lektor" => 2.0, "Guru Besar" => 2.3)
    				);
    		}
    		return view('sdm_detail', ['judul' => $judul, 'nilai' => $nilai, 'line' => $line, 'bar' => $bar]);
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
			->sortByDesc('id_jfa')
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
		$result = DB::connection('oracle_stikom_dev')->select("select nik, nip, nama, decode(sex, 1, 'Laki - Laki', 2, 'Perempuan') sex, decode(kary_type, 'DC', 'Dosen Percobaan', 'DH', 'Dosen Homebase', 'KD', 'Dosen Kontrak', 'TD', 'Dosen Tetap') kary_type, (select nama from v_fakultas where id = fakul_id) prodi,
								(select jabatan_fungsional from v_jafung where id_jabatan = (select id_jfa from v_jafung_akademik a where id_jfa = 
									(select max(id_jfa) from v_jafung_akademik where nik = a.nik) and nik = kar.nik
								)) jafung,
								decode((select jenjang_studi from V_PEND_FORMAL_KAR a where nik = kar.nik and no = 
									(select max(no) from v_pend_formal_kar where nik = a.nik and jenjang_studi is not null)
								),'S1', 'Strata 1', 'S2', 'Strata 2', 'S3', 'Strata 3') jenjang_studi
							from v_karyawan kar where nik = '$id'");
		$akademik = DB::connection('oracle_stikom_dev')->select("select no, jenjang, nama_sekolah, jenjang_studi, substr(tahun_lulus, -4) tahun_lulus, jurusan from V_PEND_FORMAL_KAR where nik = '$id'
										and lower(jenjang_studi) in ('s1','s2','s3') order by 1");										
		/*$penelitian = DB::connection('oracle_stikom_dev')->select("select mk, 'Institut Bisnis dan Informatika Stikom Surabaya' lembaga, substr(periode, -4) tahun from pantja.ewmp_b@get_ori where nik = '$id' and lower(mk) not like '%studi lanjut%'");*/
		
		$penelitian = DB::connection('oracle_stikom_dev')->select("select judul, jns, substr(smt,1,2) tahun, 'Institut Bisnis dan Informatika Stikom Surabaya' lembaga from pantja.ewmp_b_dashboard@get_ori where nik = '$id'");
		
		/*$riwayat = DB::select("select substr(smt,1,2) tahun, sum(b.sks) sks from jdwkul_mf_his a join kurlkl_mf b on a.klkl_id = b.id where a.prodi = b.fakul_id and kary_nik = '$id' group by substr(smt,1,2) order by 1");*/
		
		$riwayat = DB::connection('oracle_stikom_dev')->select("select substr(a.semester,1,2) tahun, sum(b.sks) sks from rekap_mf a join kurlkl_mf b on a.jkul_klkl_id = b.id where a.prodi = b.fakul_id and jkul_kary_nik = '$id' and sts_dosen = '*' and substr(a.semester, 1,1) <> '9' group by substr(a.semester,1,2) order by 1");
		
		return view('list_dosen_detail', ['result' => $result, 'akademik' => $akademik, 'penelitian' => $penelitian, 'line' => $riwayat]);
	}
}
