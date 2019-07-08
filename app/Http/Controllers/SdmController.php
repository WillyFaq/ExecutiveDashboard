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
use App\Penelitian;
use App\BerkasPortofolio;
use App\JenisBerkasPortofolio;
use App\ProduktifitasPkmDosen;
use App\RekognisiDosen;
use App\SertifikasiDosen;

class SdmController extends Controller
{
    public function index(Request $request)
    {
        $tahun_now = $request->input('tahun', Carbon::now()->format('Y'));
        // SKOR NILAI SDM
        $materi_sdm = MateriBorang::with([
            'nilai_latest' => function($query) use ($tahun_now) {
                return $query->where('tahun', '=', $tahun_now);
            },
        ])
        ->find(1804);
        $skor_nilai_sdm = round($materi_sdm->nilai_latest ? $materi_sdm->nilai_latest->nilai : 0, 2);
        // DATA PRODI
        $prodi = Prodi::whereIsAktif()
        ->orderByDefault()
        ->get();
        // DATA DOSEN & SERTIFIKASINYA
        $prodi_w_dosen_sertifikasi = $prodi->load(['prodi_ewmp' => function ($query) {
            return $query
            ->whereHas('karyawan', function ($query) {
                return $query
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
                ->whereIsDosenTetap()
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
        // PRESENTASE DOSEN: TETAP TIDAK TETAP
        $jml_dosen_tetap = Karyawan::whereIsDosenTetap()
        ->whereHas('prodi_ewmp')
        ->count();
        // RASIO DOSEN:MAHASISWA
        $jml_mahasiswa = Mahasiswa::whereHas('histori_kuliah', function ($query) use ($tahun_now) {
            return $query
            ->where('semester', 'LIKE', Carbon::createFromFormat('Y', $tahun_now - 1)->format('y').'1')
            ->whereIsAktif();
        })
        ->count();
        $rasio_dosen_mahasiswa = round($jml_mahasiswa / $jml_dosen_tetap, 2);
        // RASIO PRODI:DOSEN
        $jml_prodi = Prodi::whereIsAktif()
        ->count();
        $rasio_prodi_dosen = round($jml_dosen_tetap / $jml_prodi, 2);
        // JUMLAH PENELITIAN DOSEN
        $periode_ewmp = collect(range($tahun_now-2, $tahun_now));
        $penelitian_dosen = Penelitian::whereBetween(\DB::Raw("TO_CHAR(TO_DATE(SUBSTR(smt,1,2),'RR'),'YYYY')"), [$tahun_now-3, $tahun_now])
        ->get();
        $jml_penelitian_dosen = $periode_ewmp->map(function($tahun) use ($penelitian_dosen){
            return $penelitian_dosen->filter(function($penelitian_dosen) use ($tahun) {
                return Carbon::createFromFormat('y', substr($penelitian_dosen->smt, 0, 2))->format('Y') == $tahun;
            })
            ->count();
        });
        // JUMLAH PKM DOSEN
        $pkm_dosen = ProduktifitasPkmDosen::whereBetween(\DB::Raw("TO_CHAR(TO_DATE(SUBSTR(smt,1,2),'RR'),'YYYY')"), [$tahun_now-3, $tahun_now])
        ->get();
        $jml_pkm_dosen = $periode_ewmp->map(function($tahun) use ($pkm_dosen){
            return $pkm_dosen->filter(function($pkm_dosen) use ($tahun) {
                return Carbon::createFromFormat('y', substr($pkm_dosen->smt, 0, 2))->format('Y') == $tahun;
            })
            ->count();
        });
        // JUMLAH REKOGNISI DOSEN
        $rekognisi_dosen = RekognisiDosen::whereBetween(\DB::Raw("TO_CHAR(selesai,'YYYY')"), [$tahun_now-3, $tahun_now])
        ->get();
        $jml_rekognisi_dosen = $periode_ewmp->map(function($tahun) use ($rekognisi_dosen){
            return $rekognisi_dosen->filter(function($rekognisi_dosen) use ($tahun) {
                return $rekognisi_dosen->selesai->format('Y') == $tahun;
            })
            ->count();
        });
        // SKOR PENELITIAN
        $materi_penelitian = MateriBorang::with([
            'nilai_latest' => function($query) use ($tahun_now) {
                return $query->where('tahun', '=', $tahun_now);
            }
        ])
        ->find(180406);
        $skor_penelitian = round($materi_penelitian->nilai_latest ? $materi_penelitian->nilai_latest->nilai : 0, 2);
        // SKOR PKM
        $materi_pkm = MateriBorang::with([
            'nilai_latest' => function($query) use ($tahun_now) {
                return $query->where('tahun', '=', $tahun_now);
            }
        ])
        ->find(180407);
        $skor_pkm = round($materi_pkm->nilai_latest ? $materi_pkm->nilai_latest->nilai : 0, 2);
        // SKOR REKOGNISI
        $materi_rekognisi = MateriBorang::with([
            'nilai_latest' => function($query) use ($tahun_now) {
                return $query->where('tahun', '=', $tahun_now);
            }
        ])
        ->find(180408);
        $skor_rekognisi = round($materi_rekognisi->nilai_latest ? $materi_rekognisi->nilai_latest->nilai : 0, 2);
        // SKOR TENAGA KEPENDIDIKAN
        $materi_kependidikan = MateriBorang::with([
            'nilai_latest' => function($query) use ($tahun_now) {
                return $query->where('tahun', '=', $tahun_now);
            }
        ])
        ->find(180409);
        $skor_tenaga_kependidikan = round($materi_kependidikan->nilai_latest ? $materi_kependidikan->nilai_latest->nilai : 0, 2);
        // Skor Sertifikat Pendidikan
        $materi_sertifikat_pendidikan = MateriBorang::with([
            'nilai_latest' => function($query) use ($tahun_now) {
                return $query->where('tahun', '=', $tahun_now);
            }
        ])->find(180403);
        $skor_sertifikat_pendidikan = round($materi_sertifikat_pendidikan->nilai_latest ? $materi_sertifikat_pendidikan->nilai_latest->nilai : 0, 2);
        // Skor Jabatan Fungsional
        $materi_jabatan_fungsional = MateriBorang::with([
            'nilai_latest' => function($query) use ($tahun_now) {
                return $query->where('tahun', '=', $tahun_now);
            }
        ])->find(180402);
        $skor_jabatan_fungsional = round($materi_jabatan_fungsional->nilai_latest ? $materi_jabatan_fungsional->nilai_latest->nilai : 0, 2);
        // Skor Rasio Dosen Mahasiswa
        $materi_rasio_dosen_mahasiswa = MateriBorang::with([
            'nilai_latest' => function($query) use ($tahun_now) {
                return $query->where('tahun', '=', $tahun_now);
            }
        ])->find(180405);
        $skor_rasio_dosen_mahasiswa = round($materi_rasio_dosen_mahasiswa->nilai_latest ? $materi_rasio_dosen_mahasiswa->nilai_latest->nilai : 0, 2);
        // Skor Rasio Prodi Dosen
        $materi_rasio_prodi_dosen = MateriBorang::with([
            'nilai_latest' => function($query) use ($tahun_now) {
                return $query->where('tahun', '=', $tahun_now);
            }
        ])->find(180401);
        $skor_rasio_prodi_dosen = round($materi_rasio_prodi_dosen->nilai_latest ? $materi_rasio_prodi_dosen->nilai_latest->nilai : 0, 2);
        // Skor Presentase Dosen Tidak Tetap
        $materi_presentase_dosen_tidak_tetap = MateriBorang::with([
            'nilai_latest' => function($query) use ($tahun_now) {
                return $query->where('tahun', '=', $tahun_now);
            }
        ])->find(180404);
        $skor_presentase_dosen_tidak_tetap = round($materi_presentase_dosen_tidak_tetap->nilai_latest ? $materi_presentase_dosen_tidak_tetap->nilai_latest->nilai : 0, 2);
        // Judul
        $materi_borang = MateriBorang::where('kd_std','like','18040%')
        ->whereNull('keterangan')
        ->orderBy('kd_std')
        ->get()
        ->groupBy('kd_std')
        ->map(function($materi){
            return $materi->first()->nm_std;
        });

        return view('sdm', [
            'periode' => ($tahun_now - 1).'/'.$tahun_now,
            'prodi' => $prodi->map(function ($prodi) {
                return $prodi->id;
            })->toArray(),
            'periode_ewmp' => $periode_ewmp->toArray(),
            // NILAI SDM
            'skor_nilai_sdm' => $skor_nilai_sdm,
            // PRESENTASE SERTIFIKAT PENDIDIKAN
            'dosen_tetap' => $dosen_tetap->toArray(),
            'dosen_tetap_bersertifikasi' => $dosen_tetap_bersertifikasi->toArray(),
            'skor_sertifikat_pendidikan' => $skor_sertifikat_pendidikan,
            'target_dosen_tetap_bersertifikasi' => $dosen_tetap->map(function($jml_dosen) {
                $target_sertifikasi = 80/100; // KONSTANTA RUMUS BORANG
                return ceil($jml_dosen * $target_sertifikasi);
            }),
            // JABATAN FUNGSIONAL DOSEN
            'dosen_guru_besar' => $dosen_guru_besar->toArray(),
            'skor_jabatan_fungsional' => $skor_jabatan_fungsional,
            'target_dosen_guru_besar' => $dosen_tetap->map(function($jml_dosen) {
                $target_guru_besar = 15/100; // KONSTANTA RUMUS BORANG
                return ceil($jml_dosen * $target_guru_besar);
            }),
            // RASIO DOSEN:MAHASISWA
            'rasio_dosen_mahasiswa' => $rasio_dosen_mahasiswa,
            'skor_rasio_dosen_mahasiswa' => $skor_rasio_dosen_mahasiswa,
            // RASIO PRODI:DOSEN
            'rasio_prodi_dosen' => $rasio_prodi_dosen,
            'skor_rasio_prodi_dosen' => $skor_rasio_prodi_dosen,
            // PRESENTASE DOSEN: TETAP
            'jml_dosen_tetap' => $jml_dosen_tetap,
            'jml_dosen_tidak_tetap' => 0,
            'skor_presentase_dosen_tidak_tetap' => $skor_presentase_dosen_tidak_tetap,
            // EWMP
            'jml_penelitian_dosen' => $jml_penelitian_dosen->toArray(),
            'jml_pkm_dosen' => $jml_pkm_dosen->toArray(),
            'jml_rekognisi_dosen' => $jml_rekognisi_dosen->toArray(),
            'skor_penelitian' => $skor_penelitian,
            'skor_pkm' => $skor_pkm,
            'skor_rekognisi' => $skor_rekognisi,
            'skor_tenaga_kependidikan' => $skor_tenaga_kependidikan,
            // Judul
            'judul' => $materi_borang->toArray(),
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

        $jenis_sertifikasi = collect([
            [
                'nama' => 'Pendidik Profesional',
                'filter' => function($karyawan) {
                    return $karyawan->sertifikasi->filter(function($sertifikasi){
                        return $sertifikasi->jenis_sertifikasi == SertifikasiDosen::SERTIFIKASI_PENDIDIK_PROFESIONAL;
                    })->count();
                }
            ],
            [
                'nama' => 'Profesi',
                'filter' => function($karyawan) {
                    return $karyawan->sertifikasi->filter(function($sertifikasi){
                        return $sertifikasi->jenis_sertifikasi == SertifikasiDosen::SERTIFIKASI_PROFESI;
                    })->count();
                }
            ],
            [
                'nama' => 'Kompetensi',
                'filter' => function($karyawan) {
                    return $karyawan->sertifikasi->filter(function($sertifikasi){
                        return $sertifikasi->jenis_sertifikasi == SertifikasiDosen::SERTIFIKASI_KOMPETENSI;
                    })->count();
                }
            ],
        ]);

        $jenjang_studi = collect(['S1', 'S2', 'S3']);

        $data = $jenjang_studi->map(function($jenjang_studi) use ($jenis_sertifikasi, $karyawan) {
            $karyawan = $karyawan->filter(function($karyawan) use ($jenjang_studi) {
                return $karyawan->pendidikan_formal_last->jenjang_studi == $jenjang_studi;
            });
            return [
                'label' => $jenjang_studi,
                'data' => $jenis_sertifikasi->map(function($jenis_sertifikasi) use ($karyawan) {
                    return $karyawan->filter(function($karyawan) use ($jenis_sertifikasi) {
                        return $jenis_sertifikasi['filter']($karyawan);
                    })->count();
                }),
            ];
        })
        ->prepend([
            'label' => 'Jumlah Dosen',
            'data' => $jenis_sertifikasi->map(function($jenis_sertifikasi) use ($karyawan) {
                return $karyawan->filter(function($karyawan) use ($jenis_sertifikasi) {
                    return $jenis_sertifikasi['filter']($karyawan);
                })->count();
            }),
        ]);

        return [
            'nama' => $prodi->nama,
            'labels' => $jenis_sertifikasi->pluck('nama')->toArray(),
            'datasets' => $data,
        ];
    }

    public function getDosenProdiJafung(Request $request, $kode_prodi)
    {
        $prodi = Prodi::with(['prodi_ewmp' => function ($query) {
            return $query
            ->with([
                'karyawan.jabatan_fungsional_last',
                'karyawan.pendidikan_formal_last',
            ])
            ->whereHas('karyawan', function ($query) {
                return $query
                ->whereIsDosenTetap()
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
	
	public function list_dosen($kode_prodi){
        $prodi = Prodi::with(['prodi_ewmp' => function($query) {
            return $query->whereHas('karyawan', function($query) {
                return $query
                ->whereIsAktif()
                ->whereIsDosenTetap();
            })
            ->with(['karyawan' => function($query){
                return $query->with([
                    'pendidikan_formal_last' => function($query) {
                        return $query->whereNotNull('jenjang_studi');
                    },
                    'berkas_portofolio',
                    'jabatan_fungsional_last.jenis_jafung',
                ]);
            }]);
        }])
        ->find($kode_prodi);

        $list_dosen = $prodi->prodi_ewmp->map(function($prodi_ewmp) {
            return $prodi_ewmp->karyawan;
        });
        $list_dosen = $list_dosen->sortBy('nama')->values();

        $list_jafung = JenisJabatanFungsional::whereNotNull('bobot_jabatan')->get();

        $list_pendidikan = collect(['S1','S2','S3']);

        $list_sertifikasi = collect([]);

        return view('list_dosen', compact(
            'prodi',
            'list_dosen',
            'list_jafung', 
            'list_pendidikan',
            'list_sertifikasi'
        ));
	}
	
    public function getKaryawan($nik){
        $karyawan = Karyawan::find($nik);
        $karyawan->berkas_portofolio = JenisBerkasPortofolio::whereHas('berkas_portofolio', function($query) use ($nik) {
            return $query->where('nik',$nik);
        })->get();

        return $karyawan;
    }

    public function getBerkasPortofolio($nik, $id_jenis){
        return Karyawan::with(['berkas_portofolio' => function($query) use ($id_jenis) {
            return $query
            ->with('jenis_berkas_portofolio')
            ->where('id_jenis', $id_jenis);
        }])
        ->find($nik);
    }
	
	public function list_dosen_detail($kode_prodi, $nik){
        $karyawan = Karyawan::with([
            'prodi_ewmp.program_studi',
            'jabatan_fungsional_last',
            'pendidikan_formal_last',
            'pendidikan_formal' => function($query) {
                return $query->filterInJenjang(['S1','S2','S3']);
            },
            'penelitian',
            'histori_ajar' => function ($query) {
                return $query->orderBySemester();
            },
        ])
        ->find($nik);

        $histori_ajar = $karyawan->histori_ajar->groupBy(function($histori_ajar){
            return substr($histori_ajar->semester,0,2);
        })->map(function($histori_ajar, $tahun){
            return [
                'tahun' => $tahun,
                'sks' => $histori_ajar->sum('sks'),
            ];
        })
        ->values();

        return view('list_dosen_detail', [
            'result' => $karyawan, 
            'akademik' => $karyawan->pendidikan_formal,
            'penelitian' => $karyawan->penelitian,
            'line' => $histori_ajar,
        ]);
	}
}
