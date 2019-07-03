@extends('layouts.dashboard')
@section('section')

	<link href="{{ asset("css/jquery.dataTables.min.css") }}" rel="stylesheet" type="text/css">
	<script src="{{ asset("js/jquery-3.3.1.js") }}" type="text/javascript"></script>
	<script src="{{ asset("js/jquery.dataTables.min.js") }}" type="text/javascript"></script>
	
	<script src="{{ asset("js/Chart.js") }}" type="text/javascript"></script>
	<script src="{{ asset("js/utils.js") }}" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		} );
		
		$(document).ready(function() {
			$('#example2').DataTable(
			
			);
		} );
		
		$(document).ready(function() {
			$('#example3').DataTable();
		} );
	</script>
	<script>
		function test(){
			document.getElementById("riwayat-default").style.display = "none";
		}
	</script>
<div class="container container-main container-home" style="padding-top:10px;">
<div class="card">
	<p><b>Biodata Dosen S1 Sistem Informasi</b></p>
</div>
<br>
<div class="card">	
	<div class="container">
		<div class="row">
		@foreach($result as $row)
			<div class="col-6 col-md-3"> 
				<p align="center"><img src="https://sicyca.stikom.edu/static/foto/{{$row->nik}}" class="img-circle" width="135" height="150"><br>
				<b>{{$row->nama}}</b><br>({{$row->nip}})</p>
			</div>
			<div class="col-6 col-md-4">
				<table style="margin-top:25px;">
					<tr>
						<td><b>Program Studi </b></td>
						<td>&nbsp; &nbsp; : &nbsp; &nbsp;</td>
						<td>{{$row->prodi}}</td>
					</tr>
					<tr>
						<td><b>Jenis Kelamin </b></td>
						<td>&nbsp; &nbsp; : &nbsp; &nbsp;</td>
						<td>{{$row->sex}}</td>
					</tr>
					<tr>
						<td><b>Jabatan Fungsional </b></td>
						<td>&nbsp; &nbsp; : &nbsp; &nbsp;</td>
						<td>{{$row->jafung}}</td>
					</tr>
					<tr>
						<td><b>Pendidikan Tertinggi </b></td>
						<td>&nbsp; &nbsp; : &nbsp; &nbsp;</td>
						<td>{{$row->jenjang_studi}}</td>
					</tr>
					<tr>
						<td><b>Status Ikatan Kerja </b></td>
						<td>&nbsp; &nbsp; : &nbsp; &nbsp;</td>
						<td>{{$row->kary_type}}</td>
					</tr>
				</table>
			</div>
		@endforeach
			<div class="col-6 col-md-5">
				<p><b>Riwayat Mengajar</b></p>
				<canvas id="myChart"></canvas>
			</div>
		</div>
	</div>
	
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">	  
	  <li class="nav-item active">
		<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" onclick="test();" role="tab" aria-controls="pills-profile" aria-selected="true">Riwayat Pendidikan</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" onclick="test();" role="tab" aria-controls="pills-contact" aria-selected="false">Penelitian</a>
	  </li>
	</ul>
	<div class="tab-content" id="pills-tabContent" style="padding-top:20px;">
	  <div class="tab-pane fade active in" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
		<table id="example" class="display" style="width:100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Perguruan Tinggi</th>
					<th>Jurusan</th>
					<th>Tanggal Ijazah</th>
					<th>Jenjang</th>
				</tr>
			</thead>
			<tbody>
			@foreach($akademik as $i => $data)
				@php
					$no = $i + 1;
				@endphp
				<tr>
					<td>{{$no}}</td>
					<td>{{$data->nama_sekolah}}</td>
					<td>{{$data->jurusan}}</td>
					<td>{{$data->tahun_lulus}}</td>
					<td>{{$data->jenjang_studi}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	  </div>
	  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
		<table id="example2" class="display" style="width:100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Judul Penelitian</th>
					<th>Jenis</th>
					<th>Lembaga</th>
					<th>Tahun</th>
				</tr>
			</thead>
			<tbody>
			@foreach($penelitian as $i=>$data2)
				@php
				$no = $i+1;
				@endphp
				<tr>
					<td>{{$no}}</td>
					<td>{{$data2->judul}}</td>
					<td>{{$data2->jns}}</td>
					<td>{{$data2->lembaga}}</td>
					<td>20{{$data2->tahun}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	  </div>
	</div>	

</div>
</div>

<script>
var ctx = document.getElementById('myChart').getContext('2d');

var gradientFill = ctx.createLinearGradient(500, 0, 100, 0);
gradientFill.addColorStop(0, "rgba(128, 182, 244, 0.6)");
gradientFill.addColorStop(1, "rgba(244, 144, 128, 0.6)");

var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!!json_encode(array_map(function($row){
            return "20".$row->tahun;
        }, $line))!!},
        datasets: [{
            label: 'Jumlah SKS',
            data: {!!json_encode(array_map(function($row){
                return $row->sks;
            }, $line))!!},
            /*backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ]*/
			backgroundColor: gradientFill,
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                  display: false,
                    beginAtZero: true,
                    maxTicksLimit: 5,
                },
                gridLines: {
                    display: false
                }
            }]
        }
    }
});
</script>

@stop
