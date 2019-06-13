@extends('sdm')
@section('sub_section')

<head>
	<link href="{{ asset("css/jquery.dataTables.min.css") }}" rel="stylesheet" type="text/css">
	<script src="{{ asset("js/jquery-3.3.1.js") }}" type="text/javascript"></script>
	<script src="{{ asset("js/jquery.dataTables.min.js") }}" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
	
</head>

<body>
<div class="card">
	<p><b>Dosen Program Studi S1 Sistem Informasi</b></p><br>
	<table id="example" class="display" style="width:100%">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama Dosen</th>
				<th>Gelar</th>
				<th>Jenis Kelamin</th>
				<th>Pendidikan</th>
				<th>Status</th>
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
					
					if($row->pendidikan_formal[0]->jenjang_studi == 'S1'){
						$jenjang = 'Strata 1';
					}elseif($row->pendidikan_formal[0]->jenjang_studi == 'S2'){
						$jenjang = 'Strata 2';
					}elseif($row->pendidikan_formal[0]->jenjang_studi == 'S3'){
						$jenjang = 'Strata 3';
					}
					echo "<tr>
						<td>$no</td>
						<td><a href='list_dosen_detail/".$row->nik."'>".$row->nama."</a></td>
						<td>".$row->gelar_depan." ".$row->gelar_belakang."</td>
						<td>".$jk."</td>
						<td>".$jenjang."</td>
						<td>".$status."</td>";
			?>
						<td>
						<a href='' data-toggle="modal" data-target="#berkasModal<?php echo $no; ?>"><img src="{{ asset("imgs/document.png") }}" alt="Upload Berkas" width="24" height="24"></a>
						</td>
						
						
						
						
					</tr>
					<div class="modal fade" id="berkasModal<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>
						  <div class="modal-body">
								
							@foreach($row->berkas_portofolio as $berkas_portofolio)
								
								
								<p>{{$berkas_portofolio->nama_jenis}} {{$berkas_portofolio->file_path}}</p>
							
							@endforeach
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

</body>

@stop