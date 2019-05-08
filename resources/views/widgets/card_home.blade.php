<!-- begin of card -->
<style>
	.txt-score{
		margin:10px 0 0 0;
		font-weight: bold;
	}
</style>
<div class="card">
	<a href="{{ url($link) }}">
		<div class="row" style="min-height:auto">
			<div class="col-xs-12" style="clear:both; padding-top:10px ">
				<p class="txt-main pull-left" style="margin-bottom:0;font-size:1em;">{{{ isset($title) ? $title : '' }}}</p>
				
			</div>
			<div class="col-xs-6">
				@php
					$col = "txt_color_red";
					if($skor<=2){
						$col = "txt_color_red";
					}else if($skor<=3){
						$col = "txt_color_yellow";
					}else if($skor<=4){
						$col = "txt_color_green";

					}
				@endphp
				<div class="row">
					<div class="col-xs-6">
						<h1 class="txt-score {{$col}}">{{ isset($skor)?$skor:'' }}</h1>
					</div>
					<div class="col-xs-6" style="padding:10px 0 0 30px;">
						<if class="fa fa-chevron-up txt_color_green"></if>
						<if class="fa fa-chevron-down txt_color_grey"></if>
					</div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="icons_profil_sdm pull-right">
					@include('icons.'.$icon['name'], $icon['icon_arr'])
				</div>
			</div>
		</div>
	</a>
</div>
<!-- end of card -->