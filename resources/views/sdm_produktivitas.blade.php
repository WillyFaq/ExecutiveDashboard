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
			$link = '/sdm';
			$title = 'Publikasi Jurnal';
			$chart = array( 'value' => 87.5, 'skor'=> 3.5, 'type' => 2 );
			$icon = array('name' => 'gradbook', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => '3.7/4', '# Dosen ' => 40, 'Rata rata Bimbing' => 40, 'Target Minimal' => 20 );
		@endphp

		<div class="col-xs-6">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>


		@php
			$link = '/sdm';
			$title = 'Luaran (KI)';
			$chart = array( 'value' => 87.5, 'skor'=> 3.5, 'type' => 2 );
			$icon = array('name' => 'quality', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => '3.7/4', '# Dosen ' => 40, 'Rata rata Bimbing' => 40, 'Target Minimal' => 20 );
		@endphp

		<div class="col-xs-6">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>


		@php
			$link = '/sdm';
			$title = 'Sitasi Dosen';
			$chart = array( 'value' => 87.5, 'skor'=> 3.5, 'type' => 2 );
			$icon = array('name' => 'certificate', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => '3.7/4', '# Dosen ' => 40, 'Rata rata Bimbing' => 40, 'Target Minimal' => 20 );
		@endphp

		<div class="col-xs-6">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>


		@php
			$link = '/sdm';
			$title = 'Publikasi Seminar';
			$chart = array( 'value' => 87.5, 'skor'=> 3.5, 'type' => 2 );
			$icon = array('name' => 'graduate', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => '3.7/4', '# Dosen ' => 40, 'Rata rata Bimbing' => 40, 'Target Minimal' => 20 );
		@endphp

		<div class="col-xs-6">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>

	</div>
@stop