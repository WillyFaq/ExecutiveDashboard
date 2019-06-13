@extends('layouts.dashboard')
@section('page_heading','SDM')
@section('section')
<div class="container container-main container-home" style="padding-top:10px;">
	<div class="card" style="padding:5px 20px; margin:20px 5px;">
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
					<div class="col-xs-11">
						<div class="card-home-title">
							<h2>Biodata Dosen S1 SIstem Informasi</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">	
		<div class="row" style="border-bottom:1px solid #707070;padding-bottom:5px;">
			<div class="col-xs-2" >
				<img src="{{asset("imgs/foto.png")}}" alt="Foto" class="img-circle" style="width:146px;height:146px;">
				<div class="text-center card-home-title" style="width:146px;margin-top:20px;">
					<h2>MJ Dewiyani Sunarto</h2><br>
					<p class="txt_card_subtitle">(0725076301)</p>		
				</div>
			</div>
			<div class="col-xs-4">
				<table width="100%" class="tbl_detail_dosen">
					<tr>
						<th width="35%">Program Studi</th>
						<td width="5%">:</td>
						<td width="60%">Sistem Informasi</td>
					</tr>
					<tr>
						<th>Jenis Kelamin</th>
						<td>:</td>
						<td>Perempuan</td>
					</tr>
					<tr>
						<th>Jabatan Fungsional</th>
						<td>:</td>
						<td>Lektor Kepala</td>
					</tr>
					<tr>
						<th>Pendidikan Tertinggi</th>
						<td>:</td>
						<td>Strata 3</td>
					</tr>
					<tr>
						<th>Status Ikatan Kerja</th>
						<td>:</td>
						<td>Dosen Tetap</td>
					</tr>
				</table>
			</div>
			<div class="col-xs-5" style="border-left:1px solid #707070;">
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<br>
				<button class="btn btn-det-dosen btn-info" data-table=".tbl_pendidikan">Riwayat Pendidikan</button>
				<button class="btn btn-det-dosen btn-grey" data-table=".tbl_penelitian">Penelitian</button>
				<br><br>
				<table class="table tbl_sdm_dosen tbl_pendidikan">
					<thead>
						<tr>
							<th>No</th>
							<th>Perguruan Tinggi</th>
							<th>Jurusan</th>
							<th>Tanggal Ijazah</th>
							<th>Jenjang</th>
						</tr>
					</thead>
					<tbody>
						@php
							$riwayat = array(
												array("pt"=>"Universitas Sanata Dharma", "jurusan"=>"Matematika", "tgl_ijazah"=>"1988", "jenjang"=>"Strata 1"),
												array("pt"=>"Universitas Negeri Surabaya", "jurusan"=>"Magister Pendidikan", "tgl_ijazah"=>"2000", "jenjang"=>"Strata 2"),
												array("pt"=>"Universitas Negeri Surabaya", "jurusan"=>"Pasca Matematik", "tgl_ijazah"=>"2011", "jenjang"=>"Strata 3"),
											);
							$no=0;
						@endphp
						@foreach($riwayat as $key => $row)
						<tr>
							<td>{{++$no}}</td>
							<td>{{$row['pt']}}</td>
							<td>{{$row['jurusan']}}</td>
							<td>{{$row['tgl_ijazah']}}</td>
							<td>{{$row['jenjang']}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<table class="table tbl_sdm_dosen tbl_penelitian">
					<thead>
						<tr>
							<th>No</th>
							<th>Judul Penelitian</th>
							<th>Lembaga</th>
							<th>Tahun</th>
						</tr>
					</thead>
					<tbody>
						@php
							$penelitian = array(
												array("judul"=>"IbM Sistem Informasi Monitoring Perkembangan Terapi Autisme Pada Sekolah Inklusi", "lembaga"=>"STMIK Surabaya", "tahun"=>"2014"),
												array("judul"=>"IbM Sistem Informasi Monitoring Perkembangan Terapi Autisme Pada Sekolah Inklusi", "lembaga"=>"STMIK Surabaya", "tahun"=>"2014"),
												array("judul"=>"IbM Sistem Informasi Monitoring Perkembangan Terapi Autisme Pada Sekolah Inklusi", "lembaga"=>"STMIK Surabaya", "tahun"=>"2014"),
												array("judul"=>"IbM Sistem Informasi Monitoring Perkembangan Terapi Autisme Pada Sekolah Inklusi", "lembaga"=>"STMIK Surabaya", "tahun"=>"2014"),
											);
							$no=0;
						@endphp
						@foreach($penelitian as $key => $row)
						<tr>
							<td>{{++$no}}</td>
							<td>{{$row['judul']}}</td>
							<td>{{$row['lembaga']}}</td>
							<td>{{$row['tahun']}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
		$(".tbl_penelitian").hide();

		$(".btn-det-dosen").click(function(){
			if($(this).hasClass("btn-grey")){
				$(".btn-info").addClass("btn-grey");
				$(".btn-info").removeClass("btn-info");
				$(this).removeClass("btn-grey");
				$(this).addClass("btn-info");
				var table = $(this).attr("data-table");
				$(".tbl_sdm_dosen").hide(10, function(){
					$(table).show(10);
				});
			}
		});
    });
</script>
@stop