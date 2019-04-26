@extends('sdm')
@section('sub_section')
	<style>
		.txt-main{
			font-size: 1.5em;
		}
		.profil-page>div{
			padding: 0;
		}
	</style>
	<div class="row profil-page" style="margin-left:1px;">
		@php
			$nilai = 2.5;
			$link = '/sdm/profil/Dosen Tetap/'.$nilai;
			$title = 'Dosen Tetap';
			$chart = array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 );
			$icon = array('name' => 'grad', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => $nilai, 'Rasio' => '60%', '# Dosen' => 40, '# Dosen Tetap' => 12 );
			$legend = array('green' => 'Bagus (DTPS &#8805; 12)', 'yellow' => 'Menegah (DTPS 	&#60; 12) (DTPS &#62; 6)', 'red' => 'Kurang dari 2' );
		@endphp
		<div class="col-xs-4">
			@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>

		@php
			$nilai = 3.7;
			$link = '/sdm/profil/Dosen S3/'.$nilai;
			$title = 'Dosen S3';
			$chart = array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 );
			$icon = array('name' => 'gradbook', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => $nilai, '# Dosen ' => 40, '# Dosen' => 40, '# Dosen S3' => 20 );
			$legend = array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' );
		@endphp

		<div class="col-xs-4">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>


		@php
			$nilai = 3.5;
			$link = '/sdm/profil/Lektor &#38; Guru besar/'.$nilai;
			$title = 'Lektor &#38; Guru besar';
			$chart = array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 );
			$icon = array('name' => 'quality', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => $nilai, '# Dosen ' => 40, '# Dosen' => 40, '# Lektor' => 10, '# Guru Besar' => 10 );
			$legend = array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' );
		@endphp

		<div class="col-xs-4">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>


		@php
			$nilai = 3.5;
			$link = '/sdm/profil/Sertifikasi Dosen/'.$nilai;
			$title = 'Sertifikasi Dosen';
			$chart = array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 );
			$icon = array('name' => 'certificate', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => $nilai, '# Dosen ' => 40, '# Dosen' => 40, '# PSPP' => 36 );
			$legend = array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' );
		@endphp

		<div class="col-xs-4">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>


		@php
			$nilai = 3.6;
			$link = '/sdm/profil/Rasio Mahasiswa &#38; Dosen/'.$nilai;
			$title = 'Rasio Mahasiswa &#38; Dosen';
			$chart = array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 );
			$icon = array('name' => 'graduate', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => $nilai, '# Dosen ' => 40, '# Dosen' => 40, '# Dosen S3' => 36 );
			$legend = array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' );
		@endphp

		<div class="col-xs-4">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>


		@php
			$nilai = 1.2;
			$link = '/sdm/profil/Dosen Tidak Tetap/'.$nilai;
			$title = 'Dosen Tidak Tetap';
			$chart = array( 'value' => ($nilai*100/4), 'skor'=> $nilai, 'type' => 2 );
			$icon = array('name' => 'feedback', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => $nilai, '# Dosen ' => 40, '# Dosen' => 40, '# PDTT' => 20 );
			$legend = array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Tidak ada Nilai' );
		@endphp

		<div class="col-xs-4">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>
	</div>
@stop