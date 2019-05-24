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
    	}else{
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
    } 

    public function beban_kerja(){
    	return view('sdm_beban_kerja');
    }

    public function produktivitas(){
    	return view('sdm_produktivitas');
    }
}
