<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NilaiBorang;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request, $tahun_start = 2016, $tahun_end = 2017)
    {
        $nilai = NilaiBorang::with('materi')
            ->whereBetween('tahun', [$tahun_start, $tahun_end])
            ->get()
            ->groupBy('tahun')
            ->map(function ($tahun) {
                return $tahun->sum(function ($nilai) {
                    return $nilai->nilai * ($nilai->materi->persen * 100);
                });
            });
        $nilai_tahun = NilaiBorang::where('tahun', Carbon::now()->format('Y'))
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
                return $nilai_tahun->first()->nilai;
            });

        return view('home', [
            'line' => $nilai,
            'data_profil' => $nilai_tahun->toArray(),
        ]);
    }
}
