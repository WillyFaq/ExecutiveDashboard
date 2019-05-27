@extends('sdm')
@section('sub_section')
	<style>
		.txt-main{
			font-size: 1.3em;
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
		@foreach($data_profil as $key => $value)
		<div class="col-xs-4">
			@include('widgets.card_profil', $value)
		</div>
		@endforeach
		
	</div>
@stop