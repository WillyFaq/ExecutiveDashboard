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
		<div class="col-xs-12">
			<!-- begin of card -->
			@php
				$link = '/sdm';
				$title = 'EWMP';
				$chart = array( 'value' => 67.25, 'skor'=> 2.69, 'type' => 2 );
				$icon = array('name' => 'group', 'icon_arr' => array('width' => 50, 'height' => 50) );
				$data = array('Skor' => '2.5', 'Rasio' => '60%', '# Dosen' => 40, '# Dosen Tetap' => 12 );
				$legend = array('green' => 'Bagus (DTPS &#8805; 12)', 'yellow' => 'Menegah (DTPS 	&#60; 12) (DTPS &#62; 6)', 'red' => 'Kurang dari 2' );
			@endphp
			<div class="card">
				<a href="#">
					<div class="row" style="min-height:0;">
						<div class="col-xs-12" style="clear:both; ">
							<h1 class="txt-main pull-left" style="width:210px;">{{{ isset($title) ? $title : '' }}}</h1>
							<div class="icons_profil_sdm pull-right">
								@include('icons.'.$icon['name'], $icon['icon_arr'])
							</div>
						</div>
						<div class="col-xs-2" >
							@include('widgets.charts.gauge', $chart)
						</div>
						<div class="col-xs-offset-1 col-xs-2" style="padding:0px;">
							<table class="table tbl-sdm-porfil">
								<tbody>
									@foreach($data as $row => $v)
									<tr>
										<th>{{$row}}</th>
										<td>: <strong>{{$v}}</strong></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="col-xs-offset-1 col-xs-5">
							<div class="row">
								<div class="col-xs-2 sks-box sks-red">
									<h1>A</h1>
									<h5>145 SKS</h5>
								</div>
								<div class="col-xs-2 sks-box sks-green">
									<h1>B</h1>
									<h5>145 SKS</h5>
								</div>
								<div class="col-xs-2 sks-box sks-purple">
									<h1>C</h1>
									<h5>145 SKS</h5>
								</div>
								<div class="col-xs-2 sks-box sks-pink">
									<h1>D</h1>
									<h5>145 SKS</h5>
								</div>
								<div class="col-xs-2 sks-box sks-blue">
									<h1>E</h1>
									<h5>145 SKS</h5>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="row">
								<div class="col-xs-offset-4 col-xs-4">
									<div class="row legend-chart-box">
										<div class="col-xs-4">
											<dl class="dl-horizontal legend-chart">
											  	<dt><span class="dot d_green"></span></dt>
											  	<dd>{{$legend['green']}}</dd>
											</dl>
										</div>
										<div class="col-xs-4">
											<dl class="dl-horizontal legend-chart">
											  	<dt><span class="dot d_yellow"></span></dt>
											  	<dd>{{$legend['yellow']}}</dd>
											</dl>
										</div>
										<div class="col-xs-4">
											<dl class="dl-horizontal legend-chart">
											  	<dt><span class="dot d_red"></span></dt>
											  	<dd>{{$legend['red']}}</dd>
											</dl>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<!-- end of card -->
		</div>


		@php
			unset($legend);
			$link = '/sdm';
			$title = 'Dosen Pembimbing';
			$chart = array( 'value' => 92.5, 'skor'=> 3.7, 'type' => 2 );
			$icon = array('name' => 'boss', 'icon_arr' => array('width' => 50, 'height' => 50) );
		@endphp
		<div class="col-xs-6">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>

		@php
			$link = '/sdm';
			$title = 'Pengakuan Kinerja Dosen';
			$chart = array( 'value' => 87.5, 'skor'=> 3.5, 'type' => 2 );
			$icon = array('name' => 'podium', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => '3.5', '# Dosen ' => 40, 'Rata rata Bimbing' => 12, 'Target Minimal' => '20%' );
		@endphp
		<style>
			.txt-main{
				width: 300px !important;
			}
		</style>
		<div class="col-xs-6">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>
	</div>
@stop