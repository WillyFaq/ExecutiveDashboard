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
						<div class="row" style="padding-top:20px;">
							<div class="col-xs-12">
                    			@include('widgets.charts.gauge_sdm', array('value' => $skor_nilai_sdm))
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
                                        <p class="txt_card_subtitle">{{ $periode }}</p>
									</div>
								</div>
							</div>
							<div class="col-xs-4 card-home-legend">
							</div>
							<div class="col-xs-1">
							</div>
								<div class="text-center card-sdm-right top-right pg_info">
									<p class="txt_card_subtitle">Skor</p>
                                    <h1>{{ $skor_jabatan_fungsional }}</h1>
								</div>
						</div>
						<div class="row">
							<div class="col-xs-12" style="padding-top:10px;">
                                @include('widgets.charts.mixchart_sdm', [
                                    'data' => [
                                        'bar' => ['Lektor Kepala', $dosen_lektor_kepala],
                                        'line'	=> ['Guru Besar', $dosen_guru_besar ],
                                    ],
                                    'onClickFn' => 'show_modal_jafung',
                                ])
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
									<div class="col-xs-4">
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
									<div class="col-xs-4">
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
									<div class="col-xs-4">
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
										<p class="txt_card_subtitle">{{ $periode }}</p>
									</div>
								</div>
							</div>
							<div class="col-xs-4 card-home-legend">
							</div>
							<div class="col-xs-1">
							</div>
								<div class="text-center card-sdm-right top-right pg_warning">
									<p class="txt_card_subtitle">Skor</p>
                                    <h1>{{ $skor_sertifikat_pendidikan }}</h1>
								</div>
						</div>
						<div class="row">
							<div class="col-xs-12" style="padding-top:10px;">
                                @include('widgets.charts.mixchart_sdm', [
                                    'data' => [
                                        'bar' => ['Sertifikasi', $dosen_tetap_bersertifikasi],
                                        'line'	=> ['Dosen Tetap', $dosen_tetap ],
                                    ],
                                    'onClickFn' => 'show_modal_sertifikasi',
                                ])
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
                                <h1 class="txt_color_info">{{ $skor_presentase_dosen_tidak_tetap }}</h1>
								<p class="txt_card_subtitle">Skor</p>
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
										<li><span class="dot d_red"></span>Dosen Tetap : <strong>{{ $jml_dosen_tetap }} Orang</strong> </li>
										<li><span class="dot d_yellow"></span>Dosen Tidak Tetap : <strong>{{ $jml_dosen_tidak_tetap }} Orang</strong> </li>
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

<div class="modal fade" id="modal_chart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
       	 			<h4 class="modal-title" style="color:#000;font-weight:900;" id="modal_chart_label"></h4>
       	 			<p class="txt_card_subtitle">{{$periode}}</p>
       	 		</div>
		       	<div style="clear:both;"></div>
	      	</div>
	      	<div class="modal-body">
	        	<div class="row">
	        		<div class="col-xs-12">
                        <div id="load_chart">
							<canvas height="105px" id="mixchart_ajax"></canvas>
                        </div>
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
    function renderChart(mixChartData) {
        let ctxa = document.getElementById('mixchart_ajax').getContext('2d');
        if(window.chart_modal != undefined) window.chart_modal.destroy();
        window.chart_modal = new Chart(ctxa, {
            type: 'bar',
            data: mixChartData,
            options: {
                responsive: true,
                hoverMode: 'index',
                stacked: false,
                title: {
                    display: false,
                    text: 'Chart.js Line Chart - Multi Axis'
                },
                scales: {
                    xAxes: [{
                        gridLines:  {
                            display: false
                        },
                        ticks: {
                            fontSize: 10
                        },

                    }],
                    yAxes: [{
                        gridLines:  {
                            display: true,
                        },
                        type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        // id: 'y-axis-1',
                        ticks: {
                            min: 0,
                            // max: 500,
                            // stepSize: 1,
                            // suggestedMin: 0,
                            // suggestedMax: 400,
                            // fontSize: 10
                        }
                    }],
                },
                legend: {
                    display: false,
                    position: 'bottom'
                }
            }
        });
    }
    const data_prodi = {!! json_encode($prodi) !!};
    function show_modal_sertifikasi(mouseEvent, clickedChart) {
        if(clickedChart.length == 0) return;
        let prodi = data_prodi[clickedChart[0]._index];
        $.ajax({
            url: '{{url("api/sdm/dosen")}}/'+prodi+'/sertifikasi',
            success: function(result) {
                result.datasets = result.datasets.map(function(datasets){
                    if(datasets.label == 'Jumlah Dosen'){
                        datasets.borderColor = '#C216CC';
                        datasets.backgroundColor = '#C216CC';
                        datasets.borderWidth = 4;
                        datasets.fill = false;
                        datasets.type = 'line';
                        datasets.lineTension = 0;
                    }else if(datasets.label == 'Tersertifikasi'){
                        datasets.borderColor = '#BE1E2D';
                        datasets.backgroundColor = '#BE1E2D';
                    }else if(datasets.label == 'Tidak Tersertifikasi'){
                        datasets.borderColor = '#BE1E2D';
                        datasets.backgroundColor = '#BE1E2D';
                    }
                    return datasets;
                });
                renderChart(result);
                $("#modal_chart_label").html("Program Studi "+result.nama);
                $("#modal_chart").modal('show');
            }
        });
    }
    function show_modal_jafung(mouseEvent, clickedChart) {
        if(clickedChart.length == 0) return;
        let prodi = data_prodi[clickedChart[0]._index];
        $.ajax({
            url: '{{url("api/sdm/dosen")}}/'+prodi+'/jafung',
            success: function(result) {
                result.datasets = result.datasets.map(function(datasets){
                    if(datasets.label == 'Jumlah Dosen'){
                        datasets.borderColor = '#C216CC';
                        datasets.backgroundColor = '#C216CC';
                        datasets.borderWidth = 4;
                        datasets.fill = false;
                        datasets.type = 'line';
                        datasets.lineTension = 0;
                    }else if(datasets.label == 'Guru Besar'){
                        datasets.borderColor = '#FE9D28';
                        datasets.backgroundColor = '#FE9D28';
                    }else if(datasets.label == 'Lektor Kepala'){
                        datasets.borderColor = '#4FACFE';
                        datasets.backgroundColor = '#4FACFE';
                    }
                    return datasets;
                });
                renderChart(result);
                $("#modal_chart_label").html("Program Studi "+result.nama);
                $("#modal_chart").modal('show');
            }
        });
    }
</script>
@stop
