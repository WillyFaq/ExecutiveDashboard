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
		@foreach($data_profil as $key => $value)
		<div class="col-xs-4">
			@include('widgets.card_profil', $value)
		</div>
		@endforeach
		
	</div>
@stop