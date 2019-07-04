@extends('layouts.refactored.dashboard')
@section('section')

<link href="{{ asset("css/jquery.dataTables.min.css") }}" rel="stylesheet" type="text/css">
<script src="{{ asset("js/jquery.dataTables.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/utils.js") }}" type="text/javascript"></script>
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
    #profil-dosen {
        color: black;
    }
</style>
<div class="card">
    <div class="card-body">
        <a href="{{route('sdm.dosen', $result->prodi_ewmp->program_studi->id)}}">
            <img src="{{asset('imgs/baseline-arrow_back_ios-24px.svg')}}" class="back-icon float-left mr-2">
        </a>
        <span class="chart-title">Biodata Dosen {{$result->prodi_ewmp->program_studi->nama}}</span>
    </div>
</div>
<div class="card mt-2" id="profil-dosen">
    <div class="card-body">
        <div class="row">
            <div class="col-6 col-md-3"> 
                <p align="center">
                    <img src="https://sicyca.stikom.edu/static/foto/{{$result->nik}}" class="rounded-circle" width="135" height="150">
                    <b class="d-block">{{$result->nama}}</b>
                    <span class="d-block">({{$result->nip}})</span>
                </p>
            </div>
            <div class="col-6 col-md-4">
                <table style="margin-top:25px;">
                    <tr>
                        <td><b>Program Studi</b></td>
                        <td class="px-2">:</td>
                        <td>{{$result->prodi_ewmp->program_studi->nama}}</td>
                    </tr>
                    <tr>
                        <td><b>Jenis Kelamin</b></td>
                        <td class="px-2">:</td>
                        <td>{{$result->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <td><b>Jabatan Fungsional</b></td>
                        <td class="px-2">:</td>
                        <td>{{$result->nama_jabatan_fungsional_last}}</td>
                    </tr>
                    <tr>
                        <td><b>Pendidikan Tertinggi</b></td>
                        <td class="px-2">:</td>
                        <td>{{$result->jenjang_studi_last}}</td>
                    </tr>
                    <tr>
                        <td><b>Status Ikatan Kerja</b></td>
                        <td class="px-2">:</td>
                        <td>{{$result->ikatan_kerja_dosen}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-6 col-md-5">
                <p><b>Riwayat Mengajar</b></p>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    <hr class="mb-0"/>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">	  
            <li class="nav-item">
                <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Riwayat Pendidikan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Penelitian</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent" style="padding-top:20px;">
            <div class="tab-pane fade active in show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <table id="table-pendidikan" class="display" style="width:100%">
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
                <table id="table-penelitian" class="display" style="width:100%">
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
$(document).ready(function() {
    $('#table-pendidikan, #table-penelitian').DataTable({
        dom: 'rt<p>',
    });

    var ctx = document.getElementById('myChart').getContext('2d');

    var gradientFill = ctx.createLinearGradient(500, 0, 100, 0);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0.6)");
    gradientFill.addColorStop(1, "rgba(244, 144, 128, 0.6)");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!!json_encode(array_values($line->map(function($history){
                return $history['tahun'];
            })->toArray()))!!},
            datasets: [{
                label: 'Jumlah SKS',
                data: {!!json_encode(array_values($line->map(function($history){
                    return $history['sks'];
                })->toArray()))!!},
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
            legend:{
                display: false,
            },
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
});
</script>
@stop
