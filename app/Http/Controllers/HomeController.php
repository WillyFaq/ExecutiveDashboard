<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NilaiBorang;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $tahun_now = Carbon::now()->format('Y');
        // DEFAULT RANGE : TAHUN LALU - 5 s/d TAHUN LALU
        $tahun_end = $request->input('tahun_end', $tahun_now - 1);
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
        // DATA NILAI TAHUN INI
        $nilai_tahun_ini = NilaiBorang::where('tahun', $tahun_now)
            ->whereHas('materi', function ($query) {
                return $query
                    ->where('kd_jns', 1)
                    ->whereLayer(1)
                    ->where('kd_std', '!=', '1810');
            })
            ->with('materi')
            ->get()
            ->groupBy(function ($nilai_tahun) {
                return $nilai_tahun->materi->nm_std;
            })
            ->map(function ($nilai_tahun) {
                return round($nilai_tahun->first()->nilai, 2);
            });
        // DATA NILAI TAHUN INI - LAYER 0
        $nilai_tahun_ini_layer_0 = NilaiBorang::where('tahun', $tahun_now)
            ->whereHas('materi', function ($query) {
                return $query
                    ->where('kd_jns', 1)
                    ->whereLayer(0);
            })
            ->with('materi')
            ->get()
            ->groupBy(function ($nilai_tahun) {
                return $nilai_tahun->materi->nm_std;
            })
            ->map(function ($nilai_tahun) {
                return round($nilai_tahun->first()->nilai, 2);
            });
        // DATA NILAI KRITERIA KHUSUS
        $nilai_kriteria_khusus = NilaiBorang::where('tahun', $tahun_now)
            ->whereHas('materi', function ($query) {
                return $query->whereIsKriteriaKhusus();
            })
            ->with('materi')
            ->get()
            ->map(function ($nilai_tahun) {
                return [
                    $nilai_tahun->materi->nm_std,
                    round($nilai_tahun->nilai, 2),
                ];
            });

        return view('home', [
            'line' => $nilai_tahun_lalu->toArray(),
            'data_profil' => $nilai_tahun_ini->toArray(),
            'data_profil_0' => $nilai_tahun_ini_layer_0->toArray(),
            'kriteria_khusus' => $nilai_kriteria_khusus->toArray(),
        ]);
    }
}
