@extends('layouts.dashboard')
@section('section')

	<link href="{{ asset("css/jquery.dataTables.min.css") }}" rel="stylesheet" type="text/css">
	<script src="{{ asset("js/jquery-3.3.1.js") }}" type="text/javascript"></script>
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
				<?php
					$no = 1;
					foreach ($result as $row) {
						//echo $row->nik."-".$row->nama;
						if($row->sex == '1'){
							$jk = 'Laki - Laki';
						}else{
							$jk = 'Perempuan';
						}
						
						if($row->kary_type == 'DC'){
							$status = 'Dosen Percobaan';
						}elseif($row->kary_type == 'DH'){
							$status = 'Dosen Homebase';
						}elseif($row->kary_type == 'KD'){
							$status = 'Dosen Kontrak';
						}elseif($row->kary_type == 'TD'){
							$status = 'Dosen Tetap';
						}else{
							$status = '-';
						}
						
						$jenjang = '';
						if($row->pendidikan_formal){
							if($row->pendidikan_formal->jenjang_studi == 'S1'){
								$jenjang = 'Strata 1';
							}elseif($row->pendidikan_formal->jenjang_studi == 'S2'){
								$jenjang = 'Strata 2';
							}elseif($row->pendidikan_formal->jenjang_studi == 'S3'){
								$jenjang = 'Strata 3';
							}else{
								$jenjang = $row->pendidikan_formal->jenjang_studi;
							}
						}
						
						if(!isset($row->jabatan_fungsional['jenis_jafung']['jabatan_fungsional'])){
							$jafung = 'Tenaga Pengajar';
						}else{
							$jafung = $row->jabatan_fungsional['jenis_jafung']['jabatan_fungsional'];
						}
						echo "<tr>
							<td>$no</td>
							<td><a href='list_dosen_detail/".$row->nik."'>".$row->nama."</a></td>
							<td>".$row->gelar_depan." ".$row->gelar_belakang."</td>
							<td>".$jk."</td>
							<td>".$jenjang."</td>
							<td>".$jafung."</td>";
				?>
							<td>
							<a href='' data-toggle="modal" data-target="#berkasModal<?php echo $no; ?>"><img src="{{ asset("imgs/document.png") }}" alt="Upload Berkas" width="24" height="24"></a>
							</td>
							
							
							
							
						</tr>
						<div class="modal fade" id="berkasModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">{{$row->nama}} <br> ( {{$row->nip}} )</h5>
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
								@foreach($row->berkas_portofolio as $i => $berkas_portofolio)
									<div class="row">
										<div class="col-6 col-md-1">{{$i+1}}</div>
										<div class="col-6 col-md-3">{{$berkas_portofolio->nama_jenis}}</div>
										<div class="col-6 col-md-3"><a href='' data-toggle="modal" data-target="#modal_berkas_{{$berkas_portofolio->id_berkas}}">
											Lihat Detail
										</a></div>
									</div>
								@endforeach
							  </div>
							</div>
						  </div>
						</div>
						
						@foreach($row->berkas_portofolio as $berkas_portofolio)
						<div class="modal fade" id="modal_berkas_{{$berkas_portofolio->id_berkas}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">BERKAS</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
									<a href="#" class="thumbnail">
										<img src="<?=asset('imgs/berkas/'.$berkas_portofolio->file_path)?>">
									</a>
							  </div>
							</div>
						  </div>
						</div>
						@endforeach
						
						<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">modal dalam modal</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
														
								berkas
								<!--	</tbody>
								</table>
								Tes Modal 
								<img src="<?//=asset('imgs/berkas/'.$row->berkas)?>">
								-->
							  </div>
							</div>
						  </div>
						</div>
				<?php
						$no++;
					}
				?>			
			</tbody>
		</table>
	</div>

</div>
</div>
@stop
