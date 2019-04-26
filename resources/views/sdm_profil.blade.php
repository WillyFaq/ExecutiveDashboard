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
			$link = '/sdm/profil/Dosen Tetap/2.69';
			$title = 'Dosen Tetap';
			$chart = array( 'value' => 67.25, 'skor'=> 2.69, 'type' => 2 );
			$icon = array('name' => 'grad', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => '2.5', 'Rasio' => '60%', '# Dosen' => 40, '# Dosen Tetap' => 12 );
			$legend = array('green' => 'Bagus (DTPS &#8805; 12)', 'yellow' => 'Menegah (DTPS 	&#60; 12) (DTPS &#62; 6)', 'red' => 'Kurang dari 2' );
		@endphp
		<div class="col-xs-4">
			@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>

		@php
			$link = '/sdm';
			$title = 'Dosen S3';
			$chart = array( 'value' => 92.5, 'skor'=> 3.7, 'type' => 2 );
			$icon = array('name' => 'gradbook', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => '3.7', '# Dosen ' => 40, '# Dosen' => 40, '# Dosen S3' => 20 );
			$legend = array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' );
		@endphp

		<div class="col-xs-4">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>


		@php
			$link = '/sdm';
			$title = 'Lektor &#38; Guru besar';
			$chart = array( 'value' => 87.5, 'skor'=> 3.5, 'type' => 2 );
			$icon = array('name' => 'quality', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => '3.5', '# Dosen ' => 40, '# Dosen' => 40, '# Lektor' => 10, '# Guru Besar' => 10 );
			$legend = array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' );
		@endphp

		<div class="col-xs-4">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>


		@php
			$link = '/sdm';
			$title = 'Sertifikasi Dosen';
			$chart = array( 'value' => 89, 'skor'=> 3.56, 'type' => 2 );
			$icon = array('name' => 'certificate', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => '3.56', '# Dosen ' => 40, '# Dosen' => 40, '# PSPP' => 36 );
			$legend = array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' );
		@endphp

		<div class="col-xs-4">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>


		@php
			$link = '/sdm';
			$title = 'Rasio Mahasiswa &#38; Dosen';
			$chart = array( 'value' => 90, 'skor'=> 3.6, 'type' => 2 );
			$icon = array('name' => 'graduate', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => '3.6', '# Dosen ' => 40, '# Dosen' => 40, '# Dosen S3' => 36 );
			$legend = array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Kurang dari 2' );
		@endphp

		<div class="col-xs-4">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>


		@php
			$link = '/sdm';
			$title = 'Dosen Tidak Tetap';
			$chart = array( 'value' => 30, 'skor'=> 1.2, 'type' => 2 );
			$icon = array('name' => 'feedback', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => '1.2', '# Dosen ' => 40, '# Dosen' => 40, '# PDTT' => 20 );
			$legend = array('green' => 'Bagus (PS &#8805; 50%)', 'yellow' => 'Menegah (PS &#60; 50%)', 'red' => 'Tidak ada Nilai' );
		@endphp

		<div class="col-xs-4">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data, 'legend' => $legend))
		</div>
	</div>
@stop