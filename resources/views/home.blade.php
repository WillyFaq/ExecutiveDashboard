@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('section')

<script src="{{ asset("js/Chart.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/utils.js") }}" type="text/javascript"></script>
<div class="container container-main container-home" style="padding-top:10px;">
	<div class="row">
		<div class="col-xs-9">
			<div class="row main-dash">
				<div class="col-xs-5">
					<div class="card">
						<div class="row" style="">
							<div class="col-xs-3" style="padding-right:0;">
								<img src="{{ asset("imgs/logo_stikom_warna.PNG") }}" alt="Stikom" class="img-responsive img-card">
							</div>
							<div class="col-xs-9" >
								<h3 class="txt_card_title">Institut Bisnis dan Informatika Stikom Surabaya</h3>
								<p class="txt_card_subtitle">Jl. Raya Kedung Baruk No.98 <br>(031) 8721731</p>
							</div>
						</div>
						<div class="row" style="padding-top:0;padding-bottom:12px;">
							<div class="col-xs-12 card_gradient">
								<div class="row">
									<div class="col-xs-6">
										@include('widgets.charts.gauge_home', $skor['chart'])
									</div>
									<div class="col-xs-6 rangking-ket">
										<p>Status</p>
										<h3>{{$skor['status']}}</h3>
										<p>Nilai Saat ini</p>
										<h3>{{$skor['nilai']}}</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-7">
					<div class="card">
						<div class="row">
							<div class="col-xs-1 card-home-icon">
								<img src="{{ asset("imgs/chart.svg") }}" alt="chart">
							</div>
							<div class="col-xs-8 card-home-title">
								<h2>Nilai Perguruan Tinggi</h2> 
								<form class="form-inline">
									<div class="form-group select-home">
										<select class="form-control" >
											<option value="">2010</option>
											<option value="">2011</option>
											<option value="">2012</option>
										</select>
									</div>
									<div class="form-group">
										<label> - </label>
									</div>
									<div class="form-group select-home">
										<select class="form-control" >
											<option value="">2010</option>
											<option value="">2011</option>
											<option value="">2012</option>
										</select>
									</div>
								</form>
							</div>
							<div class="col-xs-3">
								<table class="tbl-legend-home" cellpadding="0" cellspacing="0">
									<tr>
										<td><div class="line-txt sts-apt-line"></div></td>
										<td>Status APT</td>
									</tr>
									<tr>
										<td><div class="line-txt nil-pt-line"></div></td>
										<td>Nilai PT</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="row" style="padding-top:0;">
							<div class="col-xs-12">
								@include('widgets.charts.linechart_home', array('data' => $line))
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row  main-dash">
				<div class="col-xs-5">
					<div class="card">
						<div class="row" style="padding-bottom:0">
							<div class="col-xs-1 card-home-icon">
								<img src="{{ asset("imgs/copy.svg") }}" alt="chart">
							</div>
							<div class="col-xs-9 card-home-title">
								<h2>Kriteria Khusus Unggul</h2> 
							</div>
							<div class="col-xs-2"></div>
						</div>
						<div class="row" style="padding-top:0">
							<div class="col-xs-12 kriteria-khusus-box">
							@foreach($kriteria_khusus as $kk => $row)
								<p>{{$row[0]}} 
									<span class="pull-right"><strong>{{$row[1]}}</strong> /4.00</span></p>
	                    		@include('widgets.progress', array('class'=>'pg_info', 'value'=>$row[1]*100/4))
							@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-7">
					<div class="card">
						<div class="row">
							<div class="col-xs-1 card-home-icon">
								<img src="{{ asset("imgs/copy.svg") }}" alt="chart">
							</div>
							<div class="col-xs-9 card-home-title">
								<h2>Kriteria Perguruan Tinggi</h2>
							</div>
							<div class="col-xs-2"></div>
							<div class=" col-xs-11 card-home-subtitle">
								<p class="txt_card_subtitle">{{$periode}}</p>
							</div>
						</div>
						<div class="row" style="padding-top:0;">
							<div class="col-xs-4 kriteria-pt-box">
								@foreach($data_profil_0 as $nama => $nilai)
									<p>{{$nama}}</p>
									<h3>{{$nilai}}</h3>
								@endforeach
							</div>
							<div class="radar-home">
	                    		@include('widgets.charts.radarchart', array('class'=>'pg_info'))
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-3" >
			<div class="row main-dash penmaru-box">
				<div class="col-xs-12">
					<div class="card" style="">
						<div class="row" style="padding:10px 10px 0 10px;">
							<div class="col-xs-1 card-home-icon">
								<img src="{{ asset("imgs/person.svg") }}" alt="chart">
							</div>
							<div class="col-xs-9 card-home-title">
								<h2>Pendaftar</h2>
							</div>
							<div class="col-xs-1 card-home-right">
								<h1>840</h1>
							</div>
							<div class="col-xs-9 card-home-subtitle">
								<p class="txt_card_subtitle">{{$periode}}</p>
							</div>
							<div class="col-xs-1 text-right card-home-right">
								<p class="txt_card_subtitle">Pendafar</p>
							</div>
						</div>
						<div class="row" style="padding-top:0;">
							<div class="col-xs-12">
								@php
									$mix = array(
												'sekarang' => ['2019',array(
																	'Jan' => 200,
																	'Feb' => 250,
																	'Mar' => 300,
																	'Apr' => 350,
																	'Mei' => 380,
																	'Jun' => 400,
																	)],
												'lalu'		=> ['2018', array(
																	'Jan' => 180,
																	'Feb' => 250,
																	'Mar' => 250,
																	'Apr' => 340,
																	'Mei' => 370,
																	'Jun' => 390,
																	) ]
												);
								
								@endphp
								@include('widgets.charts.mixchart', array('data' => $mix))
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="card" style="margin-bottom">
						<div class="row" style="padding:10px 10px 0 10px;">
							<div class="col-xs-1 card-home-icon">
								<img src="{{ asset("imgs/person.svg") }}" alt="chart">
							</div>
							<div class="col-xs-9 card-home-title">
								<h2>Registrasi</h2>
							</div>
							<div class="col-xs-1 card-home-right">
								<h1>473</h1>
							</div>
							<div class="col-xs-9 card-home-subtitle">
								<p class="txt_card_subtitle">{{$periode}}</p>
							</div>
							<div class="col-xs-1 text-right card-home-right">
								<p class="txt_card_subtitle">Register</p>
							</div>
						</div>
						<div class="row" style="padding-top:0;">
							<div class="col-xs-12">
								@include('widgets.charts.barhorizontalchart', array('data' => $regis))
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6"></div>
		<div class="col-xs-4"></div>
		<div class="col-xs-2"></div>
	</div>
	
@stop
