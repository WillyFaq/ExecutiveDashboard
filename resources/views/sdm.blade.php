@extends('layouts.refactored.dashboard')
@section('page_heading','SDM')
@section('section')
<style>
    #sdm-section .row > * > .card:not(:only-child){
        height: 141px;
    }
    #sdm-section .top-row > * > .card:only-child{
        min-height: 465px;
    }
    #sdm-section .bottom-row > * > .card:only-child{
        min-height: 468px;
    }
    #sdm-section .right-col > .card{
        background-color: #BDC3C7;
        border-color: #BDC3C7;
    }
    #sdm-section .right-col > .card > .card-body{
        padding: 15px;
    }
</style>
<link rel="stylesheet" href="{{ asset("d3-chart/gauge.css") }}">
<script src="{{ asset("d3-chart/d3.v5.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/utils.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/apexcharts.js") }}" type="text/javascript"></script>
<div id="sdm-section">
    <div class="row top-row">
        <div class="col-md-3">
            @include('component_sdm.skor')
        </div>
        <div class="col-md-6">
            @include('component_sdm.jabatan_fungsional')
        </div>
        <div class="col-md-3">
            @include('component_sdm.rasio_mhs_dosen')
            @include('component_sdm.rasio_dosen_prodi')
            @include('component_sdm.tenaga_kependidikan')
        </div>
    </div>
    <div class="row bottom-row">
        <div class="col-md-3">
            @include('component_sdm.rata_penelitian_dosen')
            @include('component_sdm.rata_pkm_dosen')
            @include('component_sdm.rata_rekognisi_dosen')
        </div>
        <div class="col-md-6">
            @include('component_sdm.persentase_sertifikat_dosen')
        </div>
        <div class="col-md-3">
            @include('component_sdm.persentase_dosen_tidak_tetap')
        </div>
    </div>
</div>
<div class="modal fade" id="modal_chart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header flushed" style="border-bottom:none;">
                <img src="{{asset('imgs/account_box.svg')}}" class="card-icon float-left mr-1"> 
                <div class="float-left">
                    <p class="chart-title mb-0" style="color:#000;font-weight:900;" id="modal_chart_label"></p>
                    <p class="chart-subtitle mb-0">{{$periode}}</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div id="load_chart">
                    <canvas height="105px" id="mixchart_ajax"></canvas>
                </div>
                <div id="legend_ajax"></div>
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
                datasets.pointRadius = 8;
                datasets.pointHoverRadius = 10;
                datasets.fill = false;
                datasets.type = 'line';
                datasets.lineTension = 0;
                datasets.datalabels = {
                    'display': true,
                    'anchor': 'center',
                    'align': 'center',
                    'color': 'white',
                };
            }else if(datasets.label == 'S1'){
                datasets.borderColor = '#95A5A6';
                datasets.backgroundColor = '#95A5A6';
                datasets.datalabels = {
                    'display': false,
                    'anchor': 'start',
                    'align': 'end',
                };
            }else if(datasets.label == 'S2'){
                datasets.borderColor = '#1ABC9C';
                datasets.backgroundColor = '#1ABC9C';
                datasets.datalabels = {
                    'display': false,
                    'anchor': 'start',
                    'align': 'end',
                };
            }else if(datasets.label == 'S3'){
                datasets.borderColor = '#34495E';
                datasets.backgroundColor = '#34495E';
                datasets.datalabels = {
                    'display': false,
                    'anchor': 'start',
                    'align': 'end',
                };
            }
            return datasets;
        });
        let ctxa = document.getElementById('mixchart_ajax').getContext('2d');
        if(window.chart_modal != undefined) window.chart_modal.destroy();
        window.chart_modal = new Chart(ctxa, {
            type: 'bar',
            data: mixChartData,
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                hoverMode: 'index',
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
                },
				legendCallback: function(chart) {
					var text = []; 
					text.push('<div class="text-center">');
					let legend_data = chart.data.datasets.map(function(data){
						return {
							label:data.label,
							backgroundColor:data.backgroundColor,
						};
					});
					legend_data.push(legend_data.shift());
					legend_data.map(function(data){
						data.label = data.label.replace(/^S([0-9])$/, "Strata $1");
						return data;
					});
					for (var i = 0; i < legend_data.length; i++) { 
						if (legend_data[i].label) { 
							text.push('<div class="chart-subtitle" style="display:inline-block; margin-right:50px;">');
							text.push('<span>');
							text.push('<div style="background-color:' + legend_data[i].backgroundColor + '; height:8px; width:8px; display:inline-block; margin-right:5px;"></div>'); 
							text.push(legend_data[i].label); 
							text.push('</span>');
							text.push('</div>');
						} 
					} 
					text.push('</div>');

					return text.join(''); 
				},
            }
        });
		document.getElementById('legend_ajax').innerHTML = window.chart_modal.generateLegend();
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
