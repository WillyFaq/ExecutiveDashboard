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
			<div class="col-xs-6" style="min-height:180px">
				@include('widgets.charts.gauge', $chart)
			</div>
			<div class="col-xs-6" style="padding:0px;">
				<table class="table tbl-sdm-porfil">
					<tbody>
						@foreach($data as $row => $v)
						<tr>
							<th>{{$row}}</th>
							<td>: <strong>{{$v}}</strong></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@php
				if(isset($legend)){
			@endphp
			<div class="col-xs-12">
				<div class="row legend-chart-box">
					<div class="col-xs-4">
						<dl class="dl-horizontal legend-chart">
						  	<dt><span class="dot d_green"></span></dt>
						  	<dd>{{$legend['green']}}</dd>
						</dl>
					</div>
					<div class="col-xs-4">
						<dl class="dl-horizontal legend-chart">
						  	<dt><span class="dot d_yellow"></span></dt>
						  	<dd>{{$legend['yellow']}}</dd>
						</dl>
					</div>
					<div class="col-xs-4">
						<dl class="dl-horizontal legend-chart">
						  	<dt><span class="dot d_red"></span></dt>
						  	<dd>{{$legend['red']}}</dd>
						</dl>
					</div>
				</div>
			</div>
			@php
				}
			@endphp
		</div>
	</a>
</div>
<!-- end of card -->