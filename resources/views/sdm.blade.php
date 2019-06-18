@extends('layouts.dashboard')
@section('page_heading','SDM')
@section('section')

<link rel="stylesheet" href="{{ asset("d3-chart/gauge.css") }}">
<script src="{{ asset("js/popper.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("d3-chart/d3.v5.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("js/chart.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/Utils.js") }}" type="text/javascript"></script>
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
						<div class="row" style="padding-top:20px;">
							<div class="col-xs-12">
                    			@include('widgets.charts.gauge_sdm', array('value' => 3.78))
							</div>
							<div class="col-xs-12">
								<div class="keterangan_box">
									<p><span class="dot d_info"></span> Baik</p>
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
							<div class="col-xs-7">
								<div class="row">
									<div class="col-xs-12 card-home-title">
										<h2>Jabatan Fungsional Dosen</h2>
									</div>
									<div class="col-xs-12 card-home-subtitle">
										<p class="txt_card_subtitle">2018/2019</p>
									</div>
								</div>
							</div>
							<div class="col-xs-4 card-home-legend">
								<ul>
									<li><span class="dot d_red"></span>Guru Besar : <strong>50 Orang</strong> </li>
									<li><span class="dot d_yellow"></span>Lekor Kepala : <strong>48 Orang</strong> </li>
								</ul>
							</div>
							<div class="col-xs-1">
							</div>
								<div class="text-center card-sdm-right top-right pg_info">
									<p class="txt_card_subtitle">Skor</p>
									<h1>1.22</h1>
								</div>
							<div class="col-xs-10 card-home-subtitle">
							</div>
							<div class="col-xs-2 text-center card-home-right">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12" style="padding-top:10px;">
								@php
								
									$mix = array(
												'bar' => ['Lektor Kepala',array(
																	'SI' => 200,
																	'TK' => 250,
																	'DKV' => 300,
																	'D3 SI' => 350,
																	'Profiti' => 380,
																	'Desgraf' => 400,
																	'Manajemen' => 400,
																	'Akuntansi' => 400,
																	'KPK' => 400,
																	)],
												'line'		=> ['Guru Besar', array(
																	'SI' => 300,
																	'TK' => 350,
																	'DKV' => 200,
																	'D3 SI' => 450,
																	'Profiti' => 480,
																	'Desgraf' => 200,
																	'Manajemen' => 200,
																	'Akuntansi' => 500,
																	'KPK' => 400,
																	) ]
												); 
								
								@endphp
								@include('widgets.charts.mixchart_sdm', array('data' => $mix))
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
										<h1 class="txt_color_info">1 : 17.2</h1>
									</div>
									<div class="col-xs-4">
										@include('widgets.charts.gauge', array( 'value' => (3.15*100/4), 'skor'=> 3.15, 'type' => 2 ))
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="card">
								<div class="row">
									<div class="col-xs-8 sdm-small-card-tittle">
										<p>Rasio Program Studi : Dosen</p>
										<h1 class="txt_color_yellow">1 : 18.7</h1>
									</div>
									<div class="col-xs-4">
										@include('widgets.charts.gauge', array( 'value' => (2.89*100/4), 'skor'=> 2.89, 'type' => 2 ))
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
											<img src="{{ asset("imgs/star-on.svg") }}" alt="On">
											<img src="{{ asset("imgs/star-on.svg") }}" alt="On">
											<img src="{{ asset("imgs/star-on.svg") }}" alt="On">
											<img src="{{ asset("imgs/star-off.svg") }}" alt="Off">
										</div>
									</div>
									<div class="col-xs-4">
										@include('widgets.charts.gauge', array( 'value' => (3*100/4), 'skor'=> 3.00, 'type' => 2 ))
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
												<li><span class="dot d_red"></span>Guru Besar : <strong>50 Orang</strong> </li>
												<li><span class="dot d_yellow"></span>Lektor Kepala : <strong>48 Orang</strong> </li>
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
												<li><span class="dot d_red"></span>Dosen Tetap : <strong>106 Orang</strong> </li>
												<li><span class="dot d_yellow"></span>Sertifiakat : <strong>80 Orang</strong> </li>
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
							<div class="card">
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
									<div class="col-xs-6">
										<table class="table-keterangan-sdm-card">
											<thead>
												<tr class="txt_color_info">
													<th>35</th>
													<th>0.05</th>
													<th>1.46</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Total</td>
													<td>Internasional</td>
													<td>Skor</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="card">
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
									<div class="col-xs-6">
										<table class="table-keterangan-sdm-card">
											<thead>
												<tr class="txt_color_yellow">
													<th>20</th>
													<th>0.39</th>
													<th>1.51</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Total</td>
													<td>Internasional</td>
													<td>Skor</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="card">
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
									<div class="col-xs-6">
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
							<div class="col-xs-7">
								<div class="row">
									<div class="col-xs-12 card-home-title">
										<h2>Persentase Sertifikat Pendidikan</h2>
									</div>
									<div class="col-xs-12 card-home-subtitle">
										<p class="txt_card_subtitle">2018/2019</p>
									</div>
								</div>
							</div>
							<div class="col-xs-4 card-home-legend">
								<ul>
									<li><span class="dot d_red"></span>Dosen Tetap : <strong>106 Orang</strong> </li>
									<li><span class="dot d_yellow"></span>Sertifiakat : <strong>80 Orang</strong> </li>
								</ul>
							</div>
							<div class="col-xs-1">
							</div>
								<div class="text-center card-sdm-right top-right pg_warning">
									<p class="txt_card_subtitle">Skor</p>
									<h1>1,46</h1>
								</div>
							<div class="col-xs-10 card-home-subtitle">
							</div>
							<div class="col-xs-2 text-center card-home-right">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12" style="padding-top:10px;">
								@php
									
									$mix = array(
												'bar' => ['Lektor Kepala',array(
																	'SI' => 500,
																	'SK' => 250,
																	'DKV' => 300,
																	'D3 SI' => 350,
																	'Profiti' => 380,
																	'Desgraf' => 400,
																	'Manajemen' => 400,
																	'Akuntansi' => 400,
																	'KPK' => 400,
																	)],
												'line'		=> ['Guru Besar', array(
																	'SI' => 300,
																	'SK' => 350,
																	'DKV' => 500,
																	'D3 SI' => 450,
																	'Profiti' => 480,
																	'Desgraf' => 200,
																	'Manajemen' => 300,
																	'Akuntansi' => 500,
																	'KPK' => 400,
																	) ]
												); 
								
								@endphp
								@include('widgets.charts.mixchart_sdm', array('data' => $mix))
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
							<div class="col-xs-2 text-center card-home-right">
								<h1 class="txt_color_info">1,46</h1>
								<p class="txt_card_subtitle">Skor</p>
							</div>
						</div>
						<div class="row" style="padding-top:20px;">
							<div class="col-xs-12">
                    			@include('widgets.charts.cpiechart', array('value' => 3.78))
							</div>
							<div class="col-xs-12 card-home-legend">
									<ul>
										<li><span class="dot d_red"></span>Dosen Tetap : <strong>106 Orang</strong> </li>
										<li><span class="dot d_yellow"></span>Sertifiakat : <strong>80 Orang</strong> </li>
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
							<p><span class="dot d_red"></span> Sertifikasi</p>
							<p><span class="dot d_yellow"></span> Guru Besar</p>
							<p><span class="dot d_info"></span> Lektor Kepala</p>
							<p><span class="dot d_purple"></span> Jumlah Dosen</p>
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
    function show_modal(label){
    	$("#modal_chart_label").html("Program Studi "+label);
    	//console.log();
		$(".modal_chart").modal('show');
    	//$("#load_chart").load('{{url('sdm/detail_ajax')}}');
    	$.ajax({
    		url:"{{url('sdm/detail_ajax')}}", 
    		success:function(result){
	    		$("#load_chart").html(result);
	  		}
	  	});
    }
</script>
@stop
