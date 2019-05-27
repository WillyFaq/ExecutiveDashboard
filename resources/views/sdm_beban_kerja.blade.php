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
		<div class="col-xs-12" style="margin-top:-10px;">
			<p class="text-indikator">
				<span class="dot d_green"></span> Bagus
				<span class="dot d_yellow"></span> Menengah
				<span class="dot d_red"></span> Buruk
			</p>
		</div>
		<div class="col-xs-12">
			<!-- begin of card -->
			@php
				$link = '/sdm';
				$title = 'EWMP';
				$skor = 2.69;
				$chart = array( 'value' => ($skor*100/4), 'skor'=> $skor, 'type' => 2 );
				$icon = array('name' => 'group', 'icon_arr' => array('width' => 50, 'height' => 50) );
				$data = array('Skor' => [($skor*100/4), '2.5'], 'Kondisi Saat Ini' => [60, '60'], '# Rata-rata SKS per-dosen' => [40, '40']);
			@endphp
			<div class="card">
				<a href="#">
					<div class="row" style="min-height:0; padding:15px 0;">
						<div class="col-xs-6" style="border-right:1px solid #A8A8A8;">
							<div class="col-xs-12" style="margin-top:-15px; ">
								<h1 class="txt-main pull-left" style="width:210px;">{{{ isset($title) ? $title : '' }}}</h1>
							</div>
							<div class="col-xs-5" style="padding:0 20px;">
								@include('widgets.charts.gauge', $chart)
							</div>
							<div class="col-xs-7" style="padding:5px 0;">
								<table class="table tbl-ket-card">
									<tbody>
										@php
											if($skor>3){
												$class = "pg_success";
											}else if($skor<=3 && $skor>=2){
												$class = "pg_warning";
											}else{
												$class = "pg_danger";
											}
										@endphp
										@foreach($data as $row => $v)
										<tr>
											<th colspan="2">{{$row}}</th>
										</tr>
										<tr>
											<td width="65%">
					                    		@include('widgets.progress', array('class'=>$class, 'striped'=>true, 'value'=>$v[0]))
											</td>
											<th style="padding-left:10px;"><span>{{$v[1]}}</span> {{{ ($row=='Skor')?"/4":(($row=='Kondisi Saat Ini')?"%":"") }}}</th>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="col-xs-12">
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
							<div class="col-xs-12" style="padding-top:20px">
								<table class="table tbl-ket-card">
									<tbody>
										<tr>
											<th width="40%">Target SKS</th>
											<td width="2%"> : </td>
											<td width="58%"> 13 SKS </td>
										</tr>
										<tr>
											<th>Rata-rata SKS per-dosen</th>
											<td> : </td>
											<td> 10 </td>
										</tr>
										<tr>
											<th># SKS Semester 181</th>
											<td> : </td>
											<td> 370.3 SKS </td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						
						
					</div>
				</a>
			</div>
			<!-- end of card -->
		</div>
		<style>
		.chat-area-box{
			min-height:110px; 
			padding:0 60px;
		}
		.second-card>.card{
			margin-bottom: 0;
		}
		</style>
		@php
			$link = '/sdm';
			$title = 'Dosen Pembimbing';
			$skor = 1.29;
			$chart = array( 'value' => ($skor*100/4), 'skor'=> $skor, 'type' => 2 );
			$icon = array('name' => 'boss', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => [($skor*100/4), $skor], 'Kondisi Saat Ini' => [20, '20'], 'PUPD per-dosen' => [15, '15']);
		@endphp
		<div class="col-xs-6 second-card">
			@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>

		
		@php
			$link = '/sdm';
			$title = 'Pengakuan Kinerja Dosen';
			$skor = 3.6;
			$chart = array( 'value' => ($skor*100/4), 'skor'=> $skor, 'type' => 2 );
			$icon = array('name' => 'podium', 'icon_arr' => array('width' => 50, 'height' => 50) );
			$data = array('Skor' => [($skor*100/4), $skor], 'Kondisi Saat Ini' => [100, '100'], 'RDD' => [40, '40']);
		@endphp
		<div class="col-xs-6 second-card">
		@include('widgets.card', array('link' => $link, 'title' => $title, 'chart' => $chart, 'icon' => $icon, 'data' => $data))
		</div>

	</div>
@stop