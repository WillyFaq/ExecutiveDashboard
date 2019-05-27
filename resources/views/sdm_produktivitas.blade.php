@extends('sdm')
@section('sub_section')
	<style>
		.txt-main{
			font-size: 1.5em;
		}
		.profil-page>div{
			padding: 0;
		}
		.chat-area-box{
			min-height:110px; 
			padding:0 60px;
		}
	</style>
	<div class="row profil-page" style="margin-left:1px;">
		<div class="col-xs-12" style="margin-top:-10px;">
			<p class="text-indikator">
				<span class="dot d_green"></span> Bagus
				<span class="dot d_yellow"></span> Menengah
				<span class="dot d_red"></span> Buruk
			</p>
		</div>
		@php
			$link = '/sdm';
			$title = 'Publikasi Jurnal';
			$skor = 1.67;
			$chart = array( 'value' => ($skor*100/4), 'skor'=> $skor, 'type' => 2 );
			$icon = array('name' => 'gradbook', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => [($skor*100/4), $skor], 'Kondisi Saat Ini' => [20, '20'], 'Publikasi Jurnal' => [15, '15']);
		@endphp

		<div class="col-xs-6">
			@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>

		@php
			$link = '/sdm';
			$title = 'Luaran (KI)';
			$skor = 2.5;
			$chart = array( 'value' => ($skor*100/4), 'skor'=> $skor, 'type' => 2 );
			$icon = array('name' => 'quality', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => [($skor*100/4), $skor], 'Kondisi Saat Ini' => [90, '90'], 'Luaran' => [15, '15']);
		@endphp

		<div class="col-xs-6">
			@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>

		@php
			$link = '/sdm';
			$title = 'Sitasi Dosen';
			$skor = 4;
			$chart = array( 'value' => ($skor*100/4), 'skor'=> $skor, 'type' => 2 );
			$icon = array('name' => 'certificate', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => [($skor*100/4), $skor], 'Kondisi Saat Ini' => [100, '100'], '# Prestasi Dosen' => [15, '15']);
		@endphp

		<div class="col-xs-6">
			@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>
		
		@php
			$link = '/sdm';
			$title = 'Publikasi Seminar';
			$skor = 2.9;
			$chart = array( 'value' => ($skor*100/4), 'skor'=> $skor, 'type' => 2 );
			$icon = array('name' => 'graduate', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => [($skor*100/4), $skor], 'Kondisi Saat Ini' => [95, '95'], '# Publikasi / Seminar' => [15, '15']);
		@endphp

		<div class="col-xs-6">
			@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>
	</div>
@stop