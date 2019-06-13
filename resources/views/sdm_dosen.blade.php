@extends('layouts.dashboard')
@section('page_heading','SDM')
@section('section')

<div class="container container-main container-home" style="padding-top:10px;">
	<div class="card">
		<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div class="col-xs-1" style="width:5.33333333%;">
						<a href="{{url('sdm')}}">
							<div class="button_icon_back">
								<i class="fa fa-angle-left" style="color:#fff;font-size:1.8em;"></i>
							</div>
						</a>	
					</div>
					<div class="col-xs-2">
						<div class="card-home-title">
							<h2 style="margin:0;">Dosen Program Studi S1 Sistem Informasi</h2>
						</div>
					</div>
					<div class="col-xs-5">
						<form action="">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon" style="background:#fff;color:#ccc;border-right:none;"><i class="fa fa-search"></i></span>
									<input type="text" class="form-control" style="border-left:none;" placeholder="Pencarian Dosen">
								</div>
							</div>
						</form>
					</div>
					<div class="col-xs-4">
					</div>
				</div>
			</div>
			<div class="col-xs-12" style="padding-top:20px;">
				<table class="table table-hover tbl_sdm_dosen">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Dosen</th>
							<th>Gelar</th>
							<th>Jenis Kelamin</th>
							<th>Pendidikan</th>
							<th>Status</th>
							<th>Acion</th>
						</tr>
					</thead>
					<tbody>
						@php
							$dosen = array(
											array("nik"=>"1123", "nama_dosen"=>"mj dewiyani sunarto", "gelar"=>"Dr M.Pd Dra", "jekel"=>"Perempuan", "pendidikan"=>"Strata 3", "status"=>"Dosen Tetap"),
											array("nik"=>"1123", "nama_dosen"=>"mj dewiyani sunarto", "gelar"=>"Dr M.Pd Dra", "jekel"=>"Perempuan", "pendidikan"=>"Strata 3", "status"=>"Dosen Tetap"),
											);	
							$no=0;
						@endphp
						@foreach($dosen as $key => $row)
						<tr>
							<td>{{++$no}}</td>
							<td><a href="{{url('sdm/dosen_detail')}}">{{$row['nama_dosen']}}</a></td>
							<td>{{$row['gelar']}}</td>
							<td>{{$row['jekel']}}</td>
							<td>{{$row['pendidikan']}}</td>
							<td>{{$row['status']}}</td>
							<td>
								<a href="#" style="color:#969696;" type="button" data-toggle="modal" data-target=".modal_document_dosen" data-nik="{{$row['nik']}}" data-nama="{{$row['nama_dosen']}}">
									<i class="fa fa-file-text"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="modal fade modal_document_dosen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      	<div class="modal-header" style="border-bottom:none;">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		       	 	<br>
	       	 		<div class="col-xs-1">
	       	 			<div style="padding:5px;width:42px;height:42px;border-radius:50%;background:rgba(150, 150, 150, 0.2);text-align:center;">
	       	 				<img src="{{ asset("imgs/person.svg") }}" alt="icon" style="width:32px;height:32px;">
	       	 			</div>
	       	 		</div>
	       	 		<div class="col-xs-11">
	       	 			<h4 class="modal-title" style="color:#000;font-weight:900;" id="modal_dosen_label">Program Studi Sistem Informasi</h4>
	       	 			<p class="txt_card_subtitle" id="modal_dosen_nik">(0725076301)</p>
	       	 		</div>
			       	<div style="clear:both;"></div>
		        </div>
		      	<div class="modal-body">
		        	<div class="load_document"></div>
		      	</div>
	    	</div>
	  	</div>
	</div>

	<script type="text/javascript">
	    $(document).ready(function(){
			$('.modal_document_dosen').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget);
				var nik = button.data('nik');
				var nama = button.data('nama');
				$("#modal_dosen_label").html(nama);
				$("#modal_dosen_nik").html('('+nik+')');
				$.ajax({
		    		url:"{{url('sdm/dosen_document')}}", 
		    		success:function(result){
			    		$(".load_document").html(result);
			  		}
			  	});
			});
	    });
	</script>
@stop
