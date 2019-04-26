@extends('sdm')
@section('sub_section')
	<style>
		.keterangan_box{
			padding: 0 30px;
			color: #A6A4BF;
		}
		.keterangan_box p{
		  display: flex;
		  flex-flow: row nowrap;
		}
	
		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
	</style>

	<script src="{{ asset("js/chart.js") }}" type="text/javascript"></script>
	<script src="{{ asset("js/Utils.js") }}" type="text/javascript"></script>
	<div class="row">
		<div class="col-xs-5">
			@include('widgets.charts.gauge', array('tittle' => $judul, 'skor'=> $nilai, 'type' => 1, 'subtittle' => 'skor' ))
		</div>
		<div class="col-xs-7">
			<div class="panel panel-main">
                <div class="panel-heading">
                     {{$judul}} Per-tahun
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                
                    @include('widgets.charts.linechart', array('data' => $line))
                </div>
                <!-- /.panel-body -->
            </div>

            <div class="panel panel-main">
                <div class="panel-heading">
                     {{$judul}} Per-prodi
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @include('widgets.charts.cbarchart', array('data' => $bar))
                </div>
                <!-- /.panel-body -->
            </div>
		</div>
	</div>
@stop