<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SdmController extends Controller
{

    public function index(){
 		$indikator_sdm = [
							array('inidkator' => 'DTPS', 'value' => 2.5 ),
							array('inidkator' => 'DTPS S3', 'value' => 3.7 ),
							array('inidkator' => 'LKGB', 'value' => 3.5 ),
							array('inidkator' => 'PSPP', 'value' => 2.56 ),
							array('inidkator' => 'DTT', 'value' => 2.5 ),
							array('inidkator' => 'Rasio antara dosen & mahasiswa', 'value' => 1.2 ),
							array('inidkator' => 'Dosen pembimbing utama', 'value' => 1.5 ),
							array('inidkator' => 'Kinerja Dosen', 'value' => 2.9 ),
							array('inidkator' => 'Pengakuan kinerja Dosen', 'value' => 3.6 ),
							array('inidkator' => 'Publikasi jurnal', 'value' => 1.67 ),
							array('inidkator' => 'Seminar/Tulisan di media masa', 'value' => 2.9 ),
							array('inidkator' => 'Sitasi Dosen', 'value' => 4 ),
							array('inidkator' => 'Luaran', 'value' => 2.5 )
						];
    	return view('sdm_utama', ['indikator_sdm' => $indikator_sdm]);
    } 

    public function profil($judul="", $nilai=""){
    	if($judul!='' || $nilai!=""){
    		return view('sdm_profil_detail', ['judul' => $judul, 'nilai' => $nilai]);
    	}else{
    		return view('sdm_profil');
    	}
    } 

    public function beban_kerja(){
    	return view('sdm_beban_kerja');
    }

    public function produktivitas(){
    	return view('sdm_produktivitas');
    }
}
