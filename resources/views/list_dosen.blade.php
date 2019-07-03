@extends('layouts.refactored.dashboard')
@section('section')

<link href="{{ asset("css/jquery.dataTables.min.css") }}" rel="stylesheet" type="text/css">
<script src="{{ asset("js/jquery.dataTables.min.js") }}" type="text/javascript"></script>
<style>
	.dataTables_wrapper .dataTables_paginate {
		float:none;
		text-align: center;
	}
	.dataTable td, 
	.dataTable th,
	.dataTable a {
		color: #000000;
		font-size: 14px;
	}
</style>
<div class="card">
	<div class="card-header flushed">
		<div class="row">
			<div class="col-md-3">
				<a href="{{url('sdm')}}">
					<img src="{{asset('imgs/baseline-arrow_back_ios-24px.svg')}}" class="card-icon float-left mr-2">
				</a>
				<span class="chart-title">Dosen Program Studi {{$prodi->nama}}</span>
			</div>
			<div class="col-md-7">
                <input id="input-filter" class="form-control">
			</div>
			<div class="col-md-2">
				<div class="dropdown">
					<button type="button" class="btn btn-default dropdown-toggle btn-block text-left" id="dropDownFilter" data-toggle="dropdown" >Filter</button>
					<div class="dropdown-menu" aria-labelledby="dropDownFilter">
						<form class="px-4 py-3">
							<div class="form-group">
								<label>Jabatan Fungsional</label>
                                <select id="input-filter-jafung" class="form-control">
									<option value="">Semua Jabatan Fungsional</option>
									@foreach($list_jafung as $jafung)
                                        @php
                                        if(!isset($_GET['jabatan_fungsional'])){
                                            $is_selected = false;
                                        }elseif($_GET['jabatan_fungsional'] == $jafung->jabatan_fungsional) {
                                            $is_selected = true;
                                        }else{
                                            $is_selected = false;
                                        }
                                        @endphp
                                        <option value="{{$jafung->id_jabatan}}" {{$is_selected?'selected':null}}>{{$jafung->jabatan_fungsional}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Sertifikasi</label>
                                <select id="input-filter-sertifikasi" class="form-control">
									<option value="">Semua Sertifikasi</option>
									@foreach($list_sertifikasi as $sertifikasi)
                                        @php
                                        if(!isset($_GET['sertifikasi'])){
                                            $is_selected = false;
                                        }elseif($_GET['sertifikasi'] == $sertifikasi) {
                                            $is_selected = true;
                                        }else{
                                            $is_selected = false;
                                        }
                                        @endphp
                                        <option value="{{$sertifikasi}}" {{$is_selected?'selected':null}}>{{$sertifikasi}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Pendidikan</label>
                                <select id="input-filter-pendidikan" class="form-control">
									<option value="">Semua Pendidikan</option>
									@foreach($list_pendidikan as $pendidikan)
                                        @php
                                        if(!isset($_GET['pendidikan'])){
                                            $is_selected = false;
                                        }elseif($_GET['pendidikan'] == $pendidikan) {
                                            $is_selected = true;
                                        }else{
                                            $is_selected = false;
                                        }
                                        @endphp
                                        <option value="{{$pendidikan}}" {{$is_selected?'selected':null}}>{{$pendidikan}}</option>
									@endforeach
								</select>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table id="table-dosen" class="display" style="width:100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Dosen</th>
					<th>Gelar</th>
					<th>Jenis Kelamin</th>
					<th>Pendidikan</th>
					<th>Status</th>
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
							<td><a href="{{route('sdm.dosen.detail', [
								$prodi->id, 
								$dosen->nik,
							])}}">{{$dosen->nama}}</a></td>
							<td>{{$dosen->gelar_depan}} {{$dosen->gelar_belakang}}</td>
							<td>{{$dosen->jenis_kelamin}}</td>
							<td>{{$dosen->jenjang_studi_last}}</td>
							<td>{{$dosen->ikatan_kerja_dosen}}</td>
							<td>{{$dosen->nama_jabatan_fungsional_last}}</td>
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
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            if ( settings.nTable.id !== 'table-dosen' ) {
                return true;
            }
            let pendidikan = $('#input-filter-pendidikan');
            if(!pendidikan.val()) return true;
            if(pendidikan.find('option:selected').text() == data[4].replace(/(.).+(.)/g, function(match, part1,part2){
                return part1+part2;
            })){
                return true;
            }
            return false;
        }
    );
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            if ( settings.nTable.id !== 'table-dosen' ) {
                return true;
            }
            let jafung = $('#input-filter-jafung');
            if(!jafung.val()) return true;
            if(jafung.find('option:selected').text() == data[6]){
                return true;
            }
            return false;
        }
    );
    // $.fn.dataTable.ext.search.push(
    //     function( settings, data, dataIndex ) {
    //         if ( settings.nTable.id !== 'table-dosen' ) {
    //             return true;
    //         }
    //         let sertifikasi = $('#input-filter-sertifikasi');
    //         if(!sertifikasi.val()) return true;
    //         return true; 
    //     }
    // );
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            if ( settings.nTable.id !== 'table-dosen' ) {
                return true;
            }
            let text = $('#input-filter');
            if(!text.val()) return true;
            return data.map(function(data_){
                console.log(
                    data_.toLowerCase(),
                    text.val().toLowerCase(),
                    data_.toLowerCase().includes(text.val().toLowerCase())
                );
                return data_.toLowerCase().includes(text.val().toLowerCase());
            }).reduce(function(prev, current){
                return prev || current;
            });
        }
    );
    $(document).ready(function() {  
        let table = $('#table-dosen').DataTable({
            "dom": 'rt<p>'
        });
        $('#input-filter-pendidikan, #input-filter-sertifikasi, #input-filter-jafung').on('change',function(){
            table.draw();
        })
        $('#input-filter').keyup(function(){
            table.draw();
        })
    } );
</script>
@stop
