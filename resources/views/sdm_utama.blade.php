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
			@include('widgets.charts.gauge', array('tittle' => 'Kondisi SDM', 'skor'=> 2.69, 'type' => 1, 'subtittle' => 'skor saat ini' ))
			<div class="keterangan_box">
				<h4><strong>Keterangan : </strong></h4>
				<p><span class="dot d_red"></span> Nilai 0 - 1</p>
				<p><span class="dot d_yellow"></span> Nilai 2 - 3</p>
				<p><span class="dot d_green"></span> Nilai > 3</p>
			</div>
		</div>
		<div class="col-xs-7">
			<div class="panel panel-main">
                <div class="panel-heading">
                     Indikator SDM
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table tbl-stipeded">
                    	<tbody>
                    		@php
								$i = 0;
								$tot = 0;
                    		@endphp
                    		@foreach($indikator_sdm as $row => $v)
	                    	<tr>
	                    		<td width="1%">{{++$i}}</td>
	                    		<td width="49%">{{ $v["inidkator"] }}</td>
	                    		<td width="35%">
									@php
										$val = $v["value"];
										$val_per = $val * 100/4;
										
										if($val>3){
											$class = "success";
										}else if($val<=3 && $val>=2){
											$class = "warning";
										}else{
											$class = "danger";
										}

										$tot += $val;
		                    		@endphp
	                    			@include('widgets.progress', array('class'=>$class, 'striped'=>true, 'value'=>$val_per))
	                    		</td>
	                    		<td  width="15%">{{$v["value"]}} / 4</td>
	                    	</tr>
	                    	@endforeach
                    	</tbody>
                    	<tfoot>
                    		<tr>
                    			<th colspan="2">Total Skors</th>
                    			<th colspan="2" class="text-right">
                    				@php
                    					$tot_per = $tot/13;
                    					if($tot_per>3){
											$class = "txt_color_green";
										}else if($tot_per<=3 && $tot_per>=2){
											$class = "txt_color_yellow";
										}else{
											$class = "txt_color_red";
										}
                    				@endphp
                    				<p class="{{$class}}">{{$tot}} ({{number_format($tot_per, 2)}})</p>
                    			</th>
                    		</tr>
                    	</tfoot>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
		</div>
	</div>
    
@stop