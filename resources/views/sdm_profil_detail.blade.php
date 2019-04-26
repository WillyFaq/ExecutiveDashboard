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


	</style>
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
                    
                </div>
                <!-- /.panel-body -->
            </div>

            <div class="panel panel-main">
                <div class="panel-heading">
                     {{$judul}} Per-prodi
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    
                </div>
                <!-- /.panel-body -->
            </div>
		</div>
	</div>
    
@stop