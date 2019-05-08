@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('section')

<script src="{{ asset("js/chart.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/Utils.js") }}" type="text/javascript"></script>
<div class="container container-main" style="padding-top:20px;">
	<div class="row">
		<div class="col-xs-7">
			<div class="panel panel-main" style="margin-bottom:0;">
                <div class="panel-heading">
                     IAPT vs IAPS
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @include('widgets.charts.linechart_home', array('data' => $line))
                </div>
                <!-- /.panel-body -->
            </div>
		</div>
		<div class="col-xs-5" style="padding:0 110px;">
			<style>
				.txt-main{
					font-size: 2em;
					margin-bottom: 20px;
				}
			</style>
			@include('widgets.charts.gauge', array('tittle' => 'Akumulasi Nilai Total', 'skor'=> 2.7, 'type' => 1, 'subtittle' => 'skor saat ini' ))
		</div>
	</div>
	<div class="row">
		<div class="col-xs-offset-10 col-xs-2">
			<div class="form-group">
				<select name="" id="" class="form-control">
					<option value="IAPT">IAPT</option>
					<option value="IAPS">IAPS</option>
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		@foreach($data_profil as $key => $value)
		<div class="col-xs-1" style="width:19.666%; padding:0;">
			@include('widgets.card_home', $value)
		</div>
		@endforeach
		
	</div>
</div>
@stop
