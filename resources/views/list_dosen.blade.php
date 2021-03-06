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
					<img src="{{asset('imgs/baseline-arrow_back_ios-24px.svg')}}" class="back-icon float-left mr-2">
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
						<tr>
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
                                <a href='#' onclick="openModalListBerkas('{{$dosen->nik}}')">
                                    <i class="fac fa-detail"></i>
                                </a>
							</td>
						</tr>
				@endforeach
			</tbody>
		</table>
	</div>
    <div class="modal fade" id="modal_list_berkas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card-header flushed pb-0">
                    <img class="foto_kary img-profile rounded-circle float-left mr-1" style="width:40px; height:40px;"> 
                    <div class="float-left">
                        <p class="chart-title mb-0 nama_kary"></p>
                        <p class="chart-subtitle mb-0 nip_kary"></p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body pt-0">
                    <table class="display" style="width:100%" id="table_berkas"></table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_berkas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card-header flushed pb-0">
                    <img class="foto_kary img-profile rounded-circle float-left mr-1" style="width:40px; height:40px;"> 
                    <div class="float-left">
                        <p class="chart-title mb-0 nama_kary"></p>
                        <p class="chart-subtitle mb-0 jenis_berkas"></p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body pt-1">
                    <div id="img_berkas" class="carousel slide d-flex justify-content-center" data-ride="carousel" data-interval="false">
                        <a class="text-dark" href="#img_berkas" role="button" data-slide="prev">
                            <i class="fa fa-chevron-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <div class="carousel-inner"></div>
                        <a class="text-dark" href="#img_berkas" role="button" data-slide="next">
                            <i class="fa fa-chevron-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function openModalListBerkas(nik){
        $.ajax({
            url: '{{route("sdm.dosen.karyawan", ":nik")}}'.replace(':nik', nik),
            success: function(result) {
                $(".foto_kary").attr({
                    src:"https://sicyca.stikom.edu/static/foto/"+result.nik
                });
                $(".nama_kary").html(result.nama);
                $(".nip_kary").html(result.nip);
                if(window.tableBerkas) window.tableBerkas.destroy();
                window.tableBerkas = $('#table_berkas').DataTable({
                    paging:   false,
                    ordering: false,
                    info:     false,
                    dom: 't',
                    data: result.berkas_portofolio,
                    columns: [
                        { title:'No', render: function(data, type, row, meta){
                            return meta.row+1;
                        }},
                        { title:'Nama Berkas', data: 'nama_jenis'},
                        { title:'Action', render: function(data, type, row){
                            return '<a href="#" onclick="openModalBerkas(\''+nik+'\','+row.id_jenis+')"><i class="fac fa-download" style="font-size:24px"></i></a>'
                        }},
                    ],
                });
                $("#modal_list_berkas").modal('show');
            }
        });
    }
    function openModalBerkas(nik, id_jenis){
        $.ajax({
            url: '{{route("sdm.dosen.berkas", [":nik",":id_jenis"])}}'.replace(':id_jenis', id_jenis).replace(':nik',nik),
            success: function(result) {
                $(".nama_kary").html(result.nama);
                $(".jenis_berkas").html(result.berkas_portofolio[0].jenis_berkas_portofolio.nama_jenis);
                $('#img_berkas').find('.carousel-inner').html(result.berkas_portofolio.map(function(berkas, index){
                    return '<div class="carousel-item :active"><p class="text-center">:page of :page_count</p><img style="width:100%" src="{{asset("imgs/berkas/:path")}}"></div>'
                    .replace(':path', berkas.file_path)
                    .replace(':active',index == 0 ? 'active' : null)
                    .replace(':page', index+1)
                    .replace(':page_count', result.berkas_portofolio.length);
                }).join(''))
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
            if(pendidikan.find('option:selected').text() == data[3].replace(/(.).+(.)/g, function(match, part1,part2){
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
            if(jafung.find('option:selected').text() == data[5]){
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
