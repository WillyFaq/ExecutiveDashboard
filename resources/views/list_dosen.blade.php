@extends('layouts.dashboard')
@section('section')

	<link href="{{ asset("css/jquery.dataTables.min.css") }}" rel="stylesheet" type="text/css">
	<script src="{{ asset("js/jquery.dataTables.min.js") }}" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		} );
		
		$(document).ready(function() {
			$('#example2').DataTable();
		} );
		
		function getprodi(){
			var prodi = document.getElementById("prodi").value;
			
			$.ajax({
				url: 'list_dosen_filter/'+prodi,
				type: 'GET',
				success: function (response){                      
					//$("#hasil_filter").replaceWith(response);
					document.getElementById("hasil_filter").innerHTML=response;					
					document.getElementById("list_dosen_default").style.display = "none";
				},
				error: function (xhr) {
					alert("Something went wrong, please try again");
				}
			});
		}
		
	</script>
	
<div class="container container-main container-home" style="padding-top:10px;">
<div class="card">
	<p><b>Dosen Institut Bisnis dan Informatika Stikom Surabaya</b></p><br>
	<p>
		Filter By : 
		<select name="prodi" id="prodi" onchange="getprodi();">
		@foreach($prodi as $hasil)
			<option value="{{$hasil->id}}">{{$hasil->alias}} ( {{$hasil->nama}} )</option>			  
		@endforeach
		</select>
	</p>
	
	<div id="hasil_filter"></div>
	
	<div id="list_dosen_default">
		<table id="example" class="display" style="width:100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Dosen</th>
					<th>Gelar</th>
					<th>Jenis Kelamin</th>
					<th>Pendidikan</th>
					<!--<th>Status</th>-->
					<th>Jabatan Fungsional</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($list_dosen as $i => $dosen)
					@php
						$no = $i + 1;
					@endphp
						<tr>
							<td>{{$no}}</td>
							<td><a href='list_dosen_detail/{{$dosen->nik}}'>{{$dosen->nama}}</a></td>
							<td>{{$dosen->gelar_depan}} {{$dosen->gelar_belakang}}</td>
							<td>{{$dosen->jenis_kelamin}}</td>
							<td>{{$dosen->jenjang_studi_last}}</td>
							<td>{{$dosen->jabatan_fungsional_last}}</td>
							<td>
							<a href='' data-toggle="modal" data-target="#berkasModal{{$no}}"><img src="{{ asset("imgs/document.png") }}" alt="Upload Berkas" width="24" height="24"></a>
							</td>
						</tr>
						<div class="modal fade" id="berkasModal{{$no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">{{$dosen->nama}} <br> ( {{$dosen->nip}} )</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
								<div class="row">
								  <div class="col-6 col-md-1">No.</div>
								  <div class="col-6 col-md-3">Nama Berkas</div>
								  <div class="col-6 col-md-3">Action</div>
								</div>
								@foreach($dosen->berkas_portofolio as $i => $berkas_portofolio)
									<div class="row">
										<div class="col-6 col-md-1">{{$i+1}}</div>
										<div class="col-6 col-md-3">{{$berkas_portofolio->nama_jenis}}</div>
                                        <div class="col-6 col-md-3">
                                            <a href="#" onclick="openModal({{$berkas_portofolio->id_berkas}})">Lihat Detail</a>
                                        </div>
									</div>
								@endforeach
							  </div>
							</div>
						  </div>
						</div>
				@endforeach
			</tbody>
		</table>
	</div>
    <div class="modal fade" id="modal_berkas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">BERKAS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="thumbnail">
                        <img id="img_berkas" src="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function openModal(id_berkas){
        $.ajax({
            url: '{{route("sdm.dosen.berkas", ":id_berkas")}}'.replace(':id_berkas', id_berkas),
            success: function(result) {
                $("#img_berkas").attr({
                    src:'{{asset("imgs/berkas/:path")}}'.replace(':path', result.file_path)
                });
                $("#modal_berkas").modal('show');
            }
        });
    }
</script>
@stop
