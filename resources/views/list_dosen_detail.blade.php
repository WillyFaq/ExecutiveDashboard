@extends('sdm')
@section('sub_section')

<head>
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
			$('#example2').DataTable();
		} );
	</script>
</head>

<body>
<div class="card">
	<p><b>Biodata Dosen S1 Sistem Informasi</b></p>
</div>
<br>
<div class="card">	
	<div class="container">
		<div class="row">
	<?php
		foreach ($result as $row) {
	?>
	
			<div class="col-6 col-md-3"> 
				<p align="center"><img src="https://sicyca.stikom.edu/static/foto/{{$row->nik}}" class="img-circle" width="135" height="150"><br>
				<b><?php echo $row->nama."</b><br>(".$row->nip.")"; ?></p>
			</div>
			<div class="col-6 col-md-5">
				<table style="margin-top:25px;">
					<tr>
						<td><b>Program Studi </b></td>
						<td>&nbsp; &nbsp; : &nbsp; &nbsp;</td>
						<td><?php	echo $row->prodi; ?></td>
					</tr>
					<tr>
						<td><b>Jenis Kelamin </b></td>
						<td>&nbsp; &nbsp; : &nbsp; &nbsp;</td>
						<td><?php	echo $row->sex; ?></td>
					</tr>
					<tr>
						<td><b>Jabatan Fungsional </b></td>
						<td>&nbsp; &nbsp; : &nbsp; &nbsp;</td>
						<td><?php	echo $row->jafung; ?></td>
					</tr>
					<tr>
						<td><b>Pendidikan Tertinggi </b></td>
						<td>&nbsp; &nbsp; : &nbsp; &nbsp;</td>
						<td><?php	echo $row->jenjang_studi; ?></td>
					</tr>
					<tr>
						<td><b>Status Ikatan Kerja </b></td>
						<td>&nbsp; &nbsp; : &nbsp; &nbsp;</td>
						<td><?php	echo $row->kary_type; ?></td>
					</tr>
				</table>
			</div>
		
	  
	<?php			
		}
	?>
			<div class="col-6 col-md-4">
			  <canvas id="myChart"></canvas>
			</div>
		</div>
	</div>
	
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">	  
	  <li class="nav-item">
		<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Riwayat Pendidikan</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Penelitian</a>
	  </li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
	  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
			<?php
			$no = 1;
			foreach($akademik as $data){
				echo "<tr>
					<td>$no</td>
					<td>".$data->nama_sekolah."</td>
					<td>".$data->jurusan."</td>
					<td>".$data->tahun_lulus."</td>
					<td>".$data->jenjang_studi."</td>
				</tr>";		
			$no++;
			}
			?>		
			</tbody>
		</table>
	  </div>
	  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
		<table id="example2" class="display" style="width:100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Judul Penelitian</th>
					<th>Bidang Ilmu</th>
					<th>Lembaga</th>				
					<th>Tahun</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = 1;
			foreach($penelitian as $data2){
				echo "<tr>
					<td>$no</td>
					<td>".$data2->mk."</td>
					<td></td>
					<td>".$data2->lembaga."</td>
					<td>".$data2->tahun."</td>
				</tr>";		
			$no++;
			}
			?>		
			</tbody>
		</table>
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
        labels: [
			<?php
			foreach($line as $row){
				echo "20".$row->tahun.",";
			}
			?>
		],
        datasets: [{
            label: 'Jumlah SKS',
            data: [				
				<?php
				foreach($line as $row){
					echo $row->sks.",";
				}
				?>
			],
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
</body>

@stop