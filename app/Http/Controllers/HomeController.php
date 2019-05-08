<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
		$line = array(
			'2011' => array("IAPT" => 2.0, "IAPS" => 2.3),
			'2012' => array("IAPT" => 2.1, "IAPS" => 2.4),
			'2013' => array("IAPT" => 2.2, "IAPS" => 2.5),
			'2014' => array("IAPT" => 2.3, "IAPS" => 2.7),
			'2015' => array("IAPT" => 2.7, "IAPS" => 2.6),
			'2016' => array("IAPT" => 2.1, "IAPS" => 2.8),
			'2017' => array("IAPT" => 3.6, "IAPS" => 3.7),
			'2018' => array("IAPT" => 3.7, "IAPS" => 3.8),
			);

		$data_profil = [];

    		$nilai = 2.5;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Sumber Daya Manusia", 
    				'link' 		=> '/sdm/profil/Dosen Tetap/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'grad', 'icon_arr' => array('width' => 50, 'height' => 50) ),
    				'data' 		=> array("skor"=>$nilai." / 4", "Rasio"=>"60%", "# Dosen"=>40, "# Dosen Tetap"=>12),
    				'legend' 	=> array('green' => 'Bagus (DTPS &#8805; 12)', 'yellow' => 'Menegah (DTPS 	&#60; 12) (DTPS &#62; 6)', 'red' => 'Kurang dari 2' )
    			)
    		);
    		$nilai = 3.7;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Lembaga", 
    				'link' 		=> '/sdm/profil/Dosen Tetap/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'gradbook', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data' 		=> array('Skor' => $nilai.' / 4', '# Dosen ' => 40, '# Dosen' => 40, '# Dosen S3' => 20 ),
					'legend' 	=> array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' )
    			)
    		);
    		$nilai = 3.5;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Kemahasiswaan", 
    				'link' 		=> '/sdm/profil/Lektor &#38; Guru besar/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart'		=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon'		=> array('name' => 'quality', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data'		=> array('Skor' => $nilai.' / 4', '# Dosen ' => 40, '# Dosen' => 40, '# Lektor' => 10, '# Guru Besar' => 10 ),
					'legend'	=> array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' )
				)
    		);
    		$nilai = 3.5;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "LITABMAS", 
    				'link' 		=> '/sdm/profil/Sertifikasi Dosen/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'certificate', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data' 		=> array('Skor' => $nilai.' / 4', '# Dosen ' => 40, '# Dosen' => 40, '# PSPP' => 36 ),
					'legend' 	=> array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' )
				)
    		);
    		$nilai = 3.6;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Inovasi", 
    				'link' 		=> '/sdm/profil/Rasio Mahasiswa &#38; Dosen/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'graduate', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data' 		=> array('Skor' => $nilai.' / 4', '# Dosen ' => 40, '# Dosen' => 40, '# Dosen S3' => 36 ),
					'legend' 	=> array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' )
				)
    		);
    		$nilai = 1.2;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Keuangan", 
    				'link' 		=> '/sdm/profil/Dosen Tidak Tetap/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'feedback', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data' 		=> array('Skor' => $nilai.' / 4', '# Dosen ' => 40, '# Dosen' => 40, '# PDTT' => 20 ),
					'legend' 	=> array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Tidak ada Nilai' )
				)
    		);

    		$nilai = 1.2;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Sumbar Daya Manusia", 
    				'link' 		=> '/sdm/profil/Dosen Tidak Tetap/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'feedback', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data' 		=> array('Skor' => $nilai.' / 4', '# Dosen ' => 40, '# Dosen' => 40, '# PDTT' => 20 ),
					'legend' 	=> array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Tidak ada Nilai' )
				)
    		);

    		$nilai = 1.2;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Sumbar Daya Manusia", 
    				'link' 		=> '/sdm/profil/Dosen Tidak Tetap/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'feedback', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data' 		=> array('Skor' => $nilai.' / 4', '# Dosen ' => 40, '# Dosen' => 40, '# PDTT' => 20 ),
					'legend' 	=> array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Tidak ada Nilai' )
				)
    		);
    		$nilai = 1.2;
    		array_push($data_profil, 
    			array(
    				'title' 	=> "Sumbar Daya Manusia", 
    				'link' 		=> '/sdm/profil/Dosen Tidak Tetap/'.$nilai,
    				'skor' 		=> $nilai, 
					'chart' 	=> array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 ),
					'icon' 		=> array('name' => 'feedback', 'icon_arr' => array('width' => 50, 'height' => 50) ),
					'data' 		=> array('Skor' => $nilai.' / 4', '# Dosen ' => 40, '# Dosen' => 40, '# PDTT' => 20 ),
					'legend' 	=> array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Tidak ada Nilai' )
				)
    		);

    	return view('home', ['indikator_sdm' => $indikator_sdm, 'line' => $line, 'data_profil' => $data_profil]);
    	//return view('home');
    } 
}
