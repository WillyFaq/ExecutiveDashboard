@php
	$document = array(
						array(
							"nama"=>"Kartu Tanda Penduduk (KTP)",
							"doc"=>"ijazah.png",
						),
						
						array(
							"nama"=>"Kartu Keluarga (KK)",
							"doc"=>"ijazah.png",
						),
						
						array(
							"nama"=>"Ijazah",
							"doc"=>"ijazah.png",
						),
						
						array(
							"nama"=>"Transkip",
							"doc"=>"ijazah.png",
						),
						
						array(
							"nama"=>"Jabatan Fungsional",
							"doc"=>"ijazah.png",
						),
						
						array(
							"nama"=>"Inpassing",
							"doc"=>"ijazah.png",
						),
						
						array(
							"nama"=>"Sertifikat Dosen",
							"doc"=>"ijazah.png",
						),
						
						array(
							"nama"=>"Sertifikat Profesi",
							"doc"=>"ijazah.png",
						),
						
						array(
							"nama"=>"Surat Keputusan",
							"doc"=>"ijazah.png",
						),
					);
	$no = 0;
@endphp
<img src="{{asset("imgs/ijazah.png")}}" class="img-responsive img-document" alt="ijazah">

<table class="table tbl_sdm_dosen tbl_dokumen_dosen">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Berkas</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($document as $key => $row)
		<tr>
			<td>{{++$no}}</td>
			<td>{{$row['nama']}}</td>
			<td>
				<a href="#" style="color:#969696;" class="link_documnet" data-doc="{{$row['doc']}}">
					<i class="fa fa-search"></i>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
		$(".img-document").hide();
		$(".link_documnet").click(function(){
			var doc = $(this).attr("data-doc");
			var src = '{{asset("imgs")}}/'+doc;
			$(".img-document").attr("src", src);
			$(".tbl_dokumen_dosen").hide(100, function(){
				$(".img-document").show(100);
			});
			return false;
		});
    });
</script>