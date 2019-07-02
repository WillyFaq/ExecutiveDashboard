@extends('layouts.dashboard')
@section('page_heading','SDM')
@section('section')

<link rel="stylesheet" href="{{ asset("d3-chart/gauge.css") }}">
<script src="{{ asset("js/popper.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("d3-chart/d3.v5.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("js/Chart.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/utils.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/apexcharts.js") }}" type="text/javascript"></script>

<div class="container container-main container-home" style="padding-top:10px;">
	<div class="row">
		<!-- group card top -->
		<div class="col-xs-12">
			<div class="row main-dash">
				<div class="col-xs-3">
					<div class="card">
						<div class="row">
							<div class="col-xs-12 card-home-title">
								<h2>Nilai SDM</h2>
							</div>
							<div class=" col-xs-12 ">
								<p class="txt_card_subtitle">Minimum :  3.50</p>
							</div>
						</div>
						<div class="row sdm-main-gauge" >
							<div class="col-xs-12">
                    			@include('widgets.charts.gauge_sdm', array('value' => $skor_nilai_sdm))
							</div>
							<div class="col-xs-12">
								<div class="keterangan_box">
									<p><span class="dot d_info"></span> Sangat Baik</p>
									<p><span class="dot d_purple"></span> Baik</p>
									<p><span class="dot d_yellow"></span> Sedang</p>
									<p><span class="dot d_red"></span> Buruk</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				

				<div class="col-xs-6">
					<div class="card" style="padding-top:10px;">
						<div class="row">
							<div class="col-xs-8">
								<div class="row">
									<div class="col-xs-12 card-home-title">
										<h2>Jabatan Fungsional Dosen</h2>
									</div>
									<div class="col-xs-12 card-home-subtitle">
                                        <p class="txt_card_subtitle">{{ $periode }}</p>
									</div>
								</div>
							</div>
							<div class="col-xs-4 card-smd-legend">
								<table class="tbl-legend-sdm" cellpadding="0" cellspacing="0">
									<tr>
										<td><div class="dot dot_dos_tetap"></div></td>
										<td><p><span>Dosen Tetap : </span>106 Orang</p></td>
									</tr>
									<tr>
										<td><div class="dot dot_gur_besar"></div></td>
										<td><p><span>Dosen Besar : </span>0 Orang</p></td>
									</tr>
								</table>
							</div>
							<div class="text-center card-sdm-right top-right pg_info">
								<p class="txt_card_subtitle">Skor</p>
                                <h1>{{ $skor_jabatan_fungsional }}</h1>
							</div>
							<!-- <div class="col-xs-10 card-home-subtitle">
							                                <input class="btn btn-default btn-sm" type="button" onclick="window.location='{{url('/sdm/list_dosen')}}'" value="Detail"/>
							</div> -->
							<div class="col-xs-2 text-center card-home-right">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 mixchart_sdm">
                                @include('widgets.charts.mixchart_sdm', array('data' => [
                                    'bar' => ['Lektor Kepala', $dosen_lektor_kepala],
                                    'line'	=> ['Guru Besar', $dosen_guru_besar ],
                                ]))
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-xs-3">
					<div class="row sdm-small-card">
						<div class="col-xs-12">
							<div class="card">
								<div class="row">
									<div class="col-xs-8 sdm-small-card-tittle">
										<p>Rasio Dosen : Mahasiswa</p>
										<h1 class="txt_color_info">1 : {{ $rasio_dosen_mahasiswa }}</h1>
									</div>
									<div class="col-xs-4 sdm-small-gauge">
                                        @include('widgets.charts.gauge', array( 'value' => (3.15*100/4), 'skor'=> $skor_rasio_dosen_mahasiswa, 'type' => 2 ))
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="card">
								<div class="row">
									<div class="col-xs-8 sdm-small-card-tittle">
										<p>Rasio Program Studi : Dosen</p>
										<h1 class="txt_color_yellow">1 : {{ $rasio_prodi_dosen }}</h1>
									</div>
									<div class="col-xs-4 sdm-small-gauge">
                                        @include('widgets.charts.gauge', array( 'value' => (2.89*100/4), 'skor'=> $skor_rasio_prodi_dosen, 'type' => 2 ))
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="card">
								<div class="row">
									<div class="col-xs-8 sdm-small-card-tittle">
										<p>Tenaga Kependidikan</p>
										<div class="star-box">
                                            @for($i=1; $i <= 4; $i++)
                                                @if($i <= $skor_tenaga_kependidikan)
                                                    <img src="{{ asset("imgs/star-on.svg") }}" alt="On">
                                                @else
                                                    <img src="{{ asset("imgs/star-off.svg") }}" alt="Off">
                                                @endif
                                            @endfor
										</div>
									</div>
									<div class="col-xs-4 sdm-small-gauge">
                                        @include('widgets.charts.gauge', array( 'value' => (3*100/4), 'skor'=> $skor_tenaga_kependidikan, 'type' => 2 ))
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end group card top -->
		<!-- group card bottom -->
		<div class="col-xs-12">
			<div class="row main-dash">

				<div class="col-xs-3">
					<div class="row sdm-small-card">
						@php
						$tampilan1=false;
						if($tampilan1):
						@endphp
						<div class="col-xs-12">
							<div class="card" style="padding:20px 40px;">
								<div class="row">
									<div class="col-xs-12 card-home-title">
										<h2>Jabatan Fungsional Doden</h2>
									</div>
									<br>
									<div class="legend_add_box">
										<div class="card-home-legend">
											<ul>
                                <li><span class="dot d_red"></span>Guru Besar : <strong>{{ array_sum(array_values($dosen_guru_besar)) }} Orang</strong> </li>
                                <li><span class="dot d_yellow"></span>Lektor Kepala : <strong>{{ array_sum(array_values($dosen_lektor_kepala)) }} Orang</strong> </li>
											</ul>
										</div>
									</div>
									<br>
									<div class="col-xs-12 card-home-title">
										<h2>Jabatan Fungsional Doden</h2>
									</div>
									<br>
									<div class="legend_add_box">
										<div class="card-home-legend">
											<ul>
                                <li><span class="dot d_red"></span>Dosen Tetap : <strong>{{ array_sum(array_values($dosen_tetap)) }} Orang</strong> </li>
                                <li><span class="dot d_yellow"></span>Sertifiakat : <strong>{{ array_sum(array_values($dosen_tetap_bersertifikasi)) }} Orang</strong> </li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						@php
						else:
						@endphp
						<div class="col-xs-12">
							<div class="card sdm-bottom-left-card">
								<div class="row">
									<div class="col-xs-12 sdm-small-card-tittle">
										<p>Rata-Rata Penelitian Dosen</p>
									</div>
									<div class="col-xs-6">
										<div class="sdm-area-grad">
											@php
												$data_area = [500, 50, 300, 400, 200, 600];
											@endphp
											@include('widgets.charts.areachart_gradient', array('color' => "default", 'data' => $data_area))
										</div>
									</div>
									<div class="col-xs-4 just-center">
										<table class="table-keterangan-sdm-card">
											<thead>
												<tr class="txt_color_info">
													<th>35</th>
													<th>0.05</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Total</td>
													<td>Internasional</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="just-right text-center card-sdm-right pg_danger">	
										<p class="txt_card_subtitle">Skor</p>
		                                <h1>1.00</h1>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="card sdm-bottom-left-card">
								<div class="row">
									<div class="col-xs-12 sdm-small-card-tittle">
										<p>Rata-Rata Penelitian Dosen</p>
									</div>
									<div class="col-xs-6">
										<div class="sdm-area-grad">
											@php
												$data_area = [500, 950, 300, 400, 200, 600];
											@endphp
											@include('widgets.charts.areachart_gradient', array('color' => "warning", 'data' => $data_area))
										</div>
									</div>
									<div class="col-xs-4">
										<table class="table-keterangan-sdm-card">
											<thead>
												<tr class="txt_color_yellow">
													<th>20</th>
													<th>0.39</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Total</td>
													<td>Internasi
												</tr>
											</tbody>
										</table>
									</div>
									<div class="just-right text-center card-sdm-right pg_danger">	
										<p class="txt_card_subtitle">Skor</p>
		                                <h1>1.00</h1>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="card sdm-bottom-left-card">
								<div class="row">
									<div class="col-xs-12 sdm-small-card-tittle">
										<p>Rata-Rata Penelitian Dosen</p>
									</div>
									<div class="col-xs-6">
										<div class="sdm-area-grad">
											@php
												$data_area = [500, 50, 30, 800, 200, 100];
											@endphp
											@include('widgets.charts.areachart_gradient', array('color' => "default", 'data' => $data_area))
										</div>
									</div>
									<div class="col-xs-4">
										<table class="table-keterangan-sdm-card">
											<thead>
												<tr class="txt_color_info">
													<th>35</th>
													<th>1.46</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Total</td>
													<td>Skor</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="just-right text-center card-sdm-right pg_purple">	
										<p class="txt_card_subtitle">Skor</p>
		                                <h1>1.00</h1>
									</div>
								</div>
							</div>
						</div>
						@php
						endif;
						@endphp
					</div>
				</div>

				<div class="col-xs-6">
					<div class="card" style="padding-top:10px;">
						<div class="row">
							<div class="col-xs-8">
								<div class="row">
									<div class="col-xs-12 card-home-title">
										<h2>Persentase Sertifikat Pendidikan</h2>
									</div>
									<div class="col-xs-12 card-home-subtitle">
										<p class="txt_card_subtitle">{{ $periode }}</p>
									</div>
								</div>
							</div>
							
							<div class="col-xs-4 card-smd-legend">
								<table class="tbl-legend-sdm" cellpadding="0" cellspacing="0">
									<tr>
										<td><div class="dot dot_dos_tetap"></div></td>
										<td><p><span>Dosen Tetap : </span>106 Orang</p></td>
									</tr>
									<tr>
										<td><div class="dot dot_gur_besar"></div></td>
										<td><p><span>Dosen Besar : </span>0 Orang</p></td>
									</tr>
								</table>
							</div>
								<div class="text-center card-sdm-right top-right pg_warning">
									<p class="txt_card_subtitle">Skor</p>
                                    <h1>{{ $skor_sertifikat_pendidikan }}</h1>
								</div>
							<!-- <div class="col-xs-10 card-home-subtitle">
							                                <input class="btn btn-default btn-sm" type="button" onclick="window.location='{{url('/sdm/list_dosen')}}'" value="Detail"/>
							</div> -->
							<div class="col-xs-2 text-center card-home-right">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12" style="padding-top:10px;">
                                @include('widgets.charts.mixchart_sdm', array('data' => [
                                    'bar' => ['Sertifikasi', $dosen_tetap_bersertifikasi],
                                    'line'	=> ['Dosen Tetap', $dosen_tetap ],
                                ]))
							</div>
						</div>
					</div>
				</div>
				

				<div class="col-xs-3">
					<div class="card">
						<div class="row">
							<div class="col-xs-10 card-home-title">
								<h2>Persentase Dosen Tidak Tetap</h2>
							</div>

								<div class="text-center card-sdm-right top-right pg_purple">
									<p class="txt_card_subtitle">Skor</p>
                                    <h1>{{ $skor_presentase_dosen_tidak_tetap }}</h1>
								</div>
						</div>
						<div class="row" style="padding-top:20px;">
							<div class="col-xs-12">
								@include('widgets.charts.cpiechart', ['data' => [
									'Dosen Tetap' => $jml_dosen_tetap,
									'Dosen Tidak Tetap' => $jml_dosen_tidak_tetap,
								]])
							</div>
							<div class="col-xs-12 card-home-legend">
									<ul>
										<li><span class="dot dot_dos_tetap"></span>Dosen Tetap : <strong>{{ $jml_dosen_tetap }} Orang</strong> </li>
										<li><span class="dot dot_gur_besar"></span>Dosen Tidak Tetap : <strong>{{ $jml_dosen_tidak_tetap }} Orang</strong> </li>
									</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end group card bottom -->
	</div>
</div>

<div class="modal fade modal_chart" id="modal_chart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      	<div class="modal-header" style="border-bottom:none;">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	       	 	<br>
       	 		<div class="col-xs-1">
       	 			<div style="padding:5px;width:42px;height:42px;border-radius:50%;background:rgba(150, 150, 150, 0.2);text-align:center;">
       	 				<img src="{{ asset("imgs/account_box.svg") }}" alt="icon" style="width:32px;height:32px;">
       	 			</div>
       	 		</div>
       	 		<div class="col-xs-11">
       	 			<h4 class="modal-title" style="color:#000;font-weight:900;" id="modal_chart_label">Program Studi Sistem Informasi</h4>
       	 			<p class="txt_card_subtitle">2018/2019</p>
       	 		</div>
		       	<div style="clear:both;"></div>
	      	</div>
	      	<div class="modal-body">
	        	<div class="row">
	        		<div class="col-xs-12">
	        			<div id="load_chart"></div>
	        		</div>
	        		<div class="col-xs-12">
	        			<div class="keterangan_box">
							<p><span class="dot d_dgrey"></span> Strata 1</p>
							<p><span class="dot d_dgreen"></span> Strata 2</p>
							<p><span class="dot d_dblue"></span> Strata 3</p>
							<p><span class="dot d_red"></span> Jumlah Dosen</p>
						</div>
	        		</div>
	        	</div>
	      	</div>
	    </div>
  	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
    	//show_modal("Sistem Informasi");
    	$('.modal_chart').on('hide.bs.modal', function () {
		  	$("#load_chart").html("");
		});
    });
    function show_modal_sertifikasi(label){
    	$("#modal_chart_label").html("Sertifikasi Program Studi "+label);
    	//console.log();
		$(".modal_chart").modal('show');
    	//$("#load_chart").load('{{url('sdm/detail_ajax')}}');
    	$.ajax({
    		url:"{{url('sdm/detail_ajax/sertifikasi')}}", 
    		success:function(result){
	    		$("#load_chart").html(result);
	  		}
	  	});
    }

    function show_modal_jafung(label){
    	$("#modal_chart_label").html("Jafung Dosen Program Studi "+label);
    	//console.log();
		$(".modal_chart").modal('show');
    	//$("#load_chart").load('{{url('sdm/detail_ajax')}}');
    	$.ajax({
    		url:"{{url('sdm/detail_ajax/jafung')}}", 
    		success:function(result){
	    		$("#load_chart").html(result);
	  		}
	  	});
    }
</script>
@stop
