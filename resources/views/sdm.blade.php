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
                    			@include('widgets.charts.gauge_sdm', array('value' => number_format($skor_nilai_sdm,2)))
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
								<div id="legend-jafung"></div>
							</div>
							<div class="text-center card-sdm-right top-right pg_info">
								<p class="txt_card_subtitle">Skor</p>
                                <h1>{{ number_format($skor_jabatan_fungsional,2) }}</h1>
							</div>
							<!-- <div class="col-xs-10 card-home-subtitle">
							                                <input class="btn btn-default btn-sm" type="button" onclick="window.location='{{url('/sdm/list_dosen')}}'" value="Detail"/>
							</div> -->
							<div class="col-xs-2 text-center card-home-right">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12" style="padding-top:10px;">
                                @include('widgets.charts.mixchart_sdm', [
                                    'data' => [
                                        'line'	=> ['Guru Besar', $dosen_guru_besar ],
                                        'bar'	=> ['Dosen Tetap', $dosen_tetap ],
                                    ],
									'onClickFn' => 'show_modal_jafung',
									'id_legend' => 'legend-jafung',
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
                                        @include('widgets.charts.gauge', [
                                            'skor'=> number_format($skor_rasio_dosen_mahasiswa,2), 
                                            'type' => 2 ,
                                        ])
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
                                        @include('widgets.charts.gauge', [
                                            'skor'=> number_format($skor_rasio_prodi_dosen,2), 
                                            'type' => 2 ,
                                        ])
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
                                        @include('widgets.charts.gauge', [
                                            'skor'=> number_format($skor_tenaga_kependidikan,2), 
                                            'type' => 2,
                                        ])
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
											@include('widgets.charts.areachart_gradient', [
												'color' => "default", 
												'data' => $jml_penelitian_dosen,
											])
										</div>
									</div>
									<div class="col-xs-4 just-center">
										<table class="table-keterangan-sdm-card">
											<thead>
												<tr class="txt_color_info">
													<th>{{array_sum(array_values($jml_penelitian_dosen))}}</th>
													<th>{{0}}</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Nasional</td>
													<td>Internasional</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="just-right text-center card-sdm-right pg_danger">	
										<p class="txt_card_subtitle">Skor</p>
		                                <h1>{{number_format($skor_penelitian,2)}}</h1>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="card sdm-bottom-left-card">
								<div class="row">
									<div class="col-xs-12 sdm-small-card-tittle">
										<p>Rata-Rata PKM Dosen</p>
									</div>
									<div class="col-xs-6">
										<div class="sdm-area-grad">
											@include('widgets.charts.areachart_gradient', [
												'color' => "default", 
												'data' => $jml_pkm_dosen,
											])
										</div>
									</div>
									<div class="col-xs-4">
										<table class="table-keterangan-sdm-card">
											<thead>
												<tr class="txt_color_yellow">
													<th>{{array_sum(array_values($jml_pkm_dosen))}}</th>
													<th>{{0}}</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Nasional</td>
													<td>Internasional</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="just-right text-center card-sdm-right pg_danger">	
										<p class="txt_card_subtitle">Skor</p>
		                                <h1>{{number_format($skor_pkm,2)}}</h1>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="card sdm-bottom-left-card">
								<div class="row">
									<div class="col-xs-12 sdm-small-card-tittle">
										<p>Rata-Rata Rekognisi Dosen</p>
									</div>
									<div class="col-xs-6">
										<div class="sdm-area-grad">
											@include('widgets.charts.areachart_gradient', [
												'color' => "default", 
												'data' => $jml_rekognisi_dosen,
											])
										</div>
									</div>
									<div class="col-xs-4">
										<table class="table-keterangan-sdm-card">
											<thead>
												<tr class="txt_color_info">
													<th>{{array_sum(array_values($jml_rekognisi_dosen))}}</th>
													<th>{{0}}</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Nasional</td>
													<td>Internasional</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="just-right text-center card-sdm-right pg_purple">	
										<p class="txt_card_subtitle">Skor</p>
		                                <h1>{{number_format($skor_rekognisi,2)}}</h1>
									</div>
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
										<h2>Persentase Sertifikat Pendidikan</h2>
									</div>
									<div class="col-xs-12 card-home-subtitle">
										<p class="txt_card_subtitle">{{ $periode }}</p>
									</div>
								</div>
							</div>
							
							<div class="col-xs-4 card-smd-legend">
								<div id="legend-sertifikasi"></div>
							</div>
								<div class="text-center card-sdm-right top-right pg_warning">
									<p class="txt_card_subtitle">Skor</p>
                                    <h1>{{ number_format($skor_sertifikat_pendidikan,2) }}</h1>
								</div>
							<!-- <div class="col-xs-10 card-home-subtitle">
							                                <input class="btn btn-default btn-sm" type="button" onclick="window.location='{{url('/sdm/list_dosen')}}'" value="Detail"/>
							</div> -->
							<div class="col-xs-2 text-center card-home-right">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12" style="padding-top:10px;">
                                @include('widgets.charts.mixchart_sdm', [
                                    'data' => [
                                        'line' => ['Sertifikasi', $dosen_tetap_bersertifikasi],
                                        'bar'	=> ['Dosen Tetap', $dosen_tetap ],
                                    ],
									'onClickFn' => 'show_modal_sertifikasi',
									'id_legend' => 'legend-sertifikasi',
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

								<div class="text-center card-sdm-right top-right pg_purple">
									<p class="txt_card_subtitle">Skor</p>
                                    <h1>{{ number_format($skor_presentase_dosen_tidak_tetap,2) }}</h1>
								</div>
						</div>
						<div class="row" style="padding-top:20px;">
							<div class="col-xs-12">
								@include('widgets.charts.cpiechart', [
									'data' => [
										'Dosen Tetap' => $jml_dosen_tetap,
										'Dosen Tidak Tetap' => $jml_dosen_tidak_tetap,
									],
									'id_legend' => 'legend-dosen',
								])
							</div>
							<div class="col-xs-12">
								<div id="legend-dosen"></div>
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
    function renderChart(mixChartData) {
        mixChartData.datasets = mixChartData.datasets.map(function(datasets){
            if(datasets.label == 'Jumlah Dosen'){
                datasets.borderColor = '#C91865';
                datasets.backgroundColor = '#C91865';
                datasets.borderWidth = 4;
                datasets.fill = false;
                datasets.type = 'line';
                datasets.lineTension = 0;
            }else if(datasets.label == 'S1'){
                datasets.borderColor = '#A358BF';
                datasets.backgroundColor = '#A358BF';
            }else if(datasets.label == 'S2'){
                datasets.borderColor = '#9E7CD7';
                datasets.backgroundColor = '#9E7CD7';
            }else if(datasets.label == 'S3'){
                datasets.borderColor = '#C2B4E2';
                datasets.backgroundColor = '#C2B4E2';
            }
            return datasets;
        });
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
                        stacked:true,
                        gridLines:  {
                            display: false
                        },
                        ticks: {
                            fontSize: 10
                        },

                    }],
                    yAxes: [{
                        stacked:true,
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
                renderChart(result);
                document.getElementById('mixchart_ajax').onclick = function(e) {
                    let bar = window.chart_modal.getElementAtEvent(e);
                    if(!bar.length) return false;
                    bar = bar[0];
                    let sertifikasi = result.labels[bar._index];
                    let pendidikan = result.datasets[bar._datasetIndex].label;
                    let param = {
                        pendidikan: pendidikan,
                        kode_prodi: prodi,
                    }
                    if(sertifikasi != 'Jumlah Dosen') {
                        param.sertifikasi = sertifikasi;
                    }
                    window.location.href = '{{route("sdm.dosen",":kode_prodi")}}?'.replace(':kode_prodi',prodi)+$.param(param);
                }
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
                renderChart(result);
                document.getElementById('mixchart_ajax').onclick = function(e) {
                    let bar = window.chart_modal.getElementAtEvent(e);
                    if(!bar.length) return false;
                    bar = bar[0];
                    let jabatan_fungsional = result.labels[bar._index];
                    let pendidikan = result.datasets[bar._datasetIndex].label;
                    let param = {
                        pendidikan: pendidikan,
                        kode_prodi: prodi,
                    }
                    if(jabatan_fungsional != 'Jumlah Dosen') {
                        param.jabatan_fungsional = jabatan_fungsional;
                    }
                    window.location.href = '{{route("sdm.dosen",":kode_prodi")}}?'.replace(':kode_prodi',prodi)+$.param(param);
                }
                $("#modal_chart_label").html("Program Studi "+result.nama);
                $("#modal_chart").modal('show');
            }
        });
    }
</script>
@stop
