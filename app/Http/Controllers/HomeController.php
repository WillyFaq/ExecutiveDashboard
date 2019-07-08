<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NilaiBorang;
use App\Mahasiswa;
use App\MateriBorang;
use Carbon\Carbon;
use App\Prodi;
use App\CalonMahasiswa;
use Carbon\CarbonPeriod;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $tahun_now = Carbon::now()->format('Y');
        $list_tahun = collect(CarbonPeriod::create(
            Carbon::now()->year('2015'),
            '1 year',
            Carbon::now()->year($tahun_now)
        )->toArray())
        ->map(function ($tahun) { return $tahun->format('Y'); });
        // NILAI TAHUN INI
        $nilai_tahun_ini = MateriBorang::where('kd_jns', 1)
        ->whereLayer(1)
        ->where('kd_std', '!=', '1810')
        ->with(['nilai' => function ($query) use ($tahun_now) {
            return $query->where('tahun', $tahun_now);
        }])
        ->get()
        ->groupBy(function ($materi) {
            return $materi->kd_std;
        })
        ->map(function ($materi) {
            $nilai = $materi->first()->nilai->first();

            return [
                'nama' => $materi->first()->nm_std,
                'nilai' => round($nilai ? $nilai->nilai : 0, 2),
            ];
        });
        // NILAI TAHUN INI LAYER 0
        $get_nilai_tahun_ini_layer_0 = function ($kd_std) use ($tahun_now) {
            return MateriBorang::where('kd_jns', 1)
            ->with(['nilai' => function ($query) use ($tahun_now) {
                return $query->where('tahun', $tahun_now);
            }])
            ->find($kd_std);
        };
        $nilai_tahun_ini_layer_0 = collect(array_map(function ($kd_std) use ($get_nilai_tahun_ini_layer_0) {
            $materi = $get_nilai_tahun_ini_layer_0($kd_std);
            $nilai = $materi->nilai->first();

            return [
                'nama' => $materi->nm_std,
                'nilai' => round($nilai ? $nilai->nilai : 0, 2),
            ];
        }, [
            'kondisi_ekternal' => 181,
            'profil_institusi' => 182,
            'pengembangan' => 183,
        ]));
        // DATA NILAI KRITERIA KHUSUS
        $nilai_kriteria_khusus = MateriBorang::whereIsKriteriaKhusus()
        ->with(['nilai' => function ($query) use ($tahun_now) {
            return $query->where('tahun', $tahun_now);
        }])
        ->get()
        ->map(function ($materi) {
            $nilai = $materi->nilai->first();

            return [$materi->nm_std, round($nilai ? $nilai->nilai : 0, 2)];
        });
        // SKOR
        $skor = NilaiBorang::with('materi')
            ->where('tahun', $tahun_now)
            ->whereHas('materi', function ($query) {
                return $query
                    ->where('kd_jns', 1)
                    ->where('kd_std', '!=', '1810')
                    ->where(function ($query_) {
                        return $query_
                            ->whereLayer(1)
                            ->orWhere(function ($query__) {
                                return $query__->whereLayer(0);
                            });
                    });
            })
            ->get()
            ->sum(function ($nilai) {
                return round($nilai->nilai * ($nilai->materi->persen * 100), 2);
            });
        // MHS REGISTRASI
        $get_mhs_registrasi = function ($tahun) {
            $prodi = Prodi::whereIsAktif()
            ->orderByDefault()
            ->get()
            ->map(function ($prodi) use ($tahun) {
                $prodi->jml_mahasiswa = Mahasiswa::where(\DB::Raw('SUBSTR(nim, 3, 5)'), $prodi->id)
                ->where(\DB::Raw("TO_CHAR(TO_DATE(SUBSTR(nim, 1, 2), 'RR'), 'YYYY')"), $tahun)
                ->where(\DB::Raw('SUBSTR(nim, 3, 5)'), $prodi->id)
                ->count();

                return $prodi;
            });

            return collect(array_combine(
                $prodi->map(function ($prodi) {
                    return $prodi->alias;
                })->toArray(),
                $prodi->map(function ($prodi) {
                    return $prodi->jml_mahasiswa;
                })->toArray()
            ));
        };
        $mhs_registrasi_lalu = $get_mhs_registrasi($tahun_now - 1);
        $mhs_registrasi_sekarang = $get_mhs_registrasi($tahun_now);
        // MHS DAFTAR
        $get_mhs_daftar = function ($tahun) {
            return CalonMahasiswa::where(
                \DB::Raw('SUBSTR(no_test,1,2)'),
                Carbon::createFromFormat('Y', $tahun)->format('y')
            )
            ->where(
                \DB::Raw("TO_CHAR(tgl_daftar,'YYYYMM')"),
                '<=',
                Carbon::now()->year($tahun)->format('Ym')
            )
            ->whereIsSiapOnline()
            ->get()
            ->sortBy('no_test');
        };
        $get_mhs_daftar_kumulatif_bulan = function ($list_bulan, $mhs_daftar) {
            $jml_mhs_daftar = $list_bulan->map(function ($bulan) use ($mhs_daftar) {
                return $mhs_daftar->filter(function ($pendaftaran) use ($bulan) {
                    return $pendaftaran->tgl_daftar <= $bulan;
                })->count();
            });

            return collect(array_combine($list_bulan->map(function ($bulan) {
                return $bulan->format('M');
            })->toArray(), $jml_mhs_daftar->toArray()));
        };
        $get_list_bulan = function ($tahun) {
            $date = Carbon::now()->year($tahun);

            return collect(CarbonPeriod::create(
                $date->copy()->subMonth(6),
                '1 month',
                $date->copy()
            )->toArray())
            ->map(function ($bulan) {
                return $bulan->endOfMonth();
            });
        };

        $mhs_daftar_lalu = $get_mhs_daftar($tahun_now - 1);
        $jml_mhs_daftar_lalu = $get_mhs_daftar_kumulatif_bulan(
            $get_list_bulan($tahun_now - 1),
            $mhs_daftar_lalu
        );
        $mhs_daftar_sekarang = $get_mhs_daftar($tahun_now);
        $jml_mhs_daftar_sekarang = $get_mhs_daftar_kumulatif_bulan(
            $get_list_bulan($tahun_now),
            $mhs_daftar_sekarang
        );

        return view('home', [
            'skor' => [
                'chart' => ['value' => 3, 'skor' => 230, 'type' => 2],
                'status' => 'Baik',
                'nilai' => $skor,
            ],
            'list_tahun' => $list_tahun->toArray(),
            'tahun_periode' => ($tahun_now - 1).'/'.$tahun_now,
            'data_profil' => $nilai_tahun_ini->toArray(),
            'data_profil_0' => $nilai_tahun_ini_layer_0->toArray(),
            'kriteria_khusus' => $nilai_kriteria_khusus->toArray(),
            'daftar' => [
                'lalu' => [
                    $tahun_now - 1,
                    $jml_mhs_daftar_lalu->toArray(),
                ],
                'sekarang' => [
                    $tahun_now,
                    $jml_mhs_daftar_sekarang->toArray(),
                ],
                'total' => $mhs_daftar_sekarang->count(),
                'total_lalu' => $mhs_daftar_lalu->count(),
            ],
            'regis' => [
                'lalu' => [
                    $tahun_now - 1,
                    $mhs_registrasi_lalu->toArray(),
                ],
                'sekarang' => [
                    $tahun_now,
                    $mhs_registrasi_sekarang->toArray(),
                ],
                'total' => $mhs_registrasi_sekarang->flatten()->sum(),
                'total_lalu' => $mhs_registrasi_lalu->flatten()->sum(),
            ],
            'periode' => ($tahun_now - 1).'/'.$tahun_now,
        ]);
    }

    public function getNilaiPerguruanTinggi(Request $request)
    {
        $tahun_now = Carbon::now()->format('Y');
        // DEFAULT RANGE : TAHUN LALU - 5 s/d TAHUN LALU
        $tahun_param = collect($request->input('tahun', [$tahun_now, $tahun_now - 5]))->sort();
        $tahun_start = $tahun_param->first();
        $tahun_end = $tahun_param->last();
        $list_tahun = collect(CarbonPeriod::create(
            Carbon::now()->year('2014'),
            '1 year',
            Carbon::now()->year($tahun_now)
        )->toArray())
        ->map(function ($tahun) { return $tahun->format('Y'); });
        // DATA NILAI PER TAHUN
        $nilai_tahun_lalu = NilaiBorang::with('materi')
            ->whereBetween('tahun', [$tahun_start, $tahun_end])
            ->whereHas('materi', function ($query) {
                return $query
                    ->where('kd_jns', 1)
                    ->where('kd_std', '!=', '1810')
                    ->where(function ($query_) {
                        return $query_
                            ->whereLayer(1)
                            ->orWhere(function ($query__) {
                                return $query__->whereLayer(0);
                            });
                    });
            })
            ->get();
        $range_tahun_lalu = $list_tahun
        ->filter(function ($tahun) use ($tahun_start, $tahun_end) {
            return $tahun >= $tahun_start && $tahun <= $tahun_end;
        });
        $nilai_tahun_lalu = $range_tahun_lalu->map(function ($tahun) use ($nilai_tahun_lalu) {
            return $nilai_tahun_lalu->filter(function ($nilai) use ($tahun) {
                return $nilai->tahun == $tahun;
            })
            ->sum(function ($nilai) {
                return round($nilai->nilai * ($nilai->materi->persen * 100), 2);
            });
        });
        $nilai_tahun_lalu = collect(array_combine(
            $range_tahun_lalu->toArray(),
            $nilai_tahun_lalu->toArray()
        ));

        return $nilai_tahun_lalu;
    }
}
