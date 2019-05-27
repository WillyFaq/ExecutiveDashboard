<!-- begin of card -->
<div class="card">
	<a href="{{ url($link) }}">
		<div class="row">
			<div class="col-xs-12" style="clear:both; ">
				<h1 class="txt-main pull-left" style="width:210px;">{{{ isset($title) ? $title : '' }}}</h1>
				<div class="icons_profil_sdm pull-right">
					@include('icons.'.$icon['name'], $icon['icon_arr'])
				</div>
			</div>
			<div class="col-xs-6" style="min-height:110px">
				@include('widgets.charts.gauge', $chart)
			</div>
			<div class="col-xs-6" style="padding:0px;">
				<table class="table tbl-sdm-porfil">
					<tbody>
						@php
							if($skor>3){
								$class = "pg_success";
							}else if($skor<=3 && $skor>=2){
								$class = "pg_warning";
							}else{
								$class = "pg_danger";
							}
						@endphp
						@foreach($data as $row => $v)
						<tr>
							<th colspan="2">{{$row}}</th>
						</tr>
						<tr>
							<td width="65%">
	                    		@include('widgets.progress', array('class'=>$class, 'striped'=>true, 'value'=>$v[0]))
							</td>
							<th style="padding-left:10px;"><span>{{$v[1]}}</span> {{{ ($row=='Skor')?"/4":(($row=='Kondisi Saat Ini')?"%":"") }}}</th>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</a>
</div>
<!-- end of card -->