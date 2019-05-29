<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NilaiBorang;
use App\Mahasiswa;
use App\MateriBorang;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $tahun_now = $request->input('tahun', Carbon::now()->format('Y'));
        // DEFAULT RANGE : TAHUN LALU - 5 s/d TAHUN LALU
        $tahun_end = $request->input('tahun_end', $tahun_now);
        $tahun_start = $request->input('tahun_start', $tahun_end - 5);
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
            ->get()
            ->groupBy('tahun')
            ->map(function ($tahun) {
                return $tahun->sum(function ($nilai) {
                    return round($nilai->nilai * ($nilai->materi->persen * 100), 2);
                });
            });
        $nilai_tahun_ini = MateriBorang::where('kd_jns', 1)
        ->whereLayer(1)
        ->where('kd_std', '!=', '1810')
        ->with(['nilai' => function ($query) use ($tahun_now) {
            return $query->where('tahun', $tahun_now);
        }])
        ->get()
        ->groupBy(function ($materi) {
            return $materi->nm_std;
        })
        ->map(function ($materi) {
            $nilai = $materi->first()->nilai->first();

            return round($nilai ? $nilai->nilai : 0, 2);
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
            'profil_institusi' => 181,
            'kondisi_ekternal' => 182,
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
            return Mahasiswa::where(\DB::raw("TO_CHAR(TO_DATE(SUBSTR(nim, 0, 2),'RR'),'YYYY')"), $tahun)
            ->with('prodi')
            ->select(['nim', \DB::raw("TO_CHAR(TO_DATE(SUBSTR(nim, 0, 2),'RR'),'YYYY') AS tahun")])
            ->get()
            ->groupBy(function ($mahasiswa) {
                return $mahasiswa->prodi->alias;
            })
            ->map(function ($prodi) {
                return $prodi->count();
            })
            ->sort();
        };
        $mhs_registrasi_lalu = $get_mhs_registrasi($tahun_now - 1);
        $mhs_registrasi_sekarang = $get_mhs_registrasi($tahun_now);

        return view('home', [
            'skor' => [
                'chart' => ['value' => 3, 'skor' => 230, 'type' => 2],
                'status' => 'Baik',
                'nilai' => $skor,
            ],
            'line' => $nilai_tahun_lalu->toArray(),
            'data_profil' => $nilai_tahun_ini->toArray(),
            'data_profil_0' => $nilai_tahun_ini_layer_0->toArray(),
            'kriteria_khusus' => $nilai_kriteria_khusus->toArray(),
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
            ],
            'periode' => ($tahun_now - 1).'/'.$tahun_now,
        ]);
    }
}
