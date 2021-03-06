@extends('layouts.dashboard')
@section('page_heading','SDM')
@section('section')

<link rel="stylesheet" href="{{ asset("d3-chart/gauge.css") }}">
<script src="{{ asset("js/popper.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("d3-chart/d3.v5.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("js/Chart.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/utils.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/apexcharts.js") }}" type="text/javascript"></script>

<div class="container container-main container-home" style="padding-top:10px;">
    <div class="row">
        <div class="col-xs-8">
            <div class="card" style="margin-bottom:10px">
                <div class="row">
                    <div class="col-xs-12">
                        <h4>{{ $prodi['fakultas']['nama'] }}</h4>
                        <h3>{{ $prodi['nama'] }}</h3>
                        <h5>{{ $prodi['web'] }}</h5>
                        <a href="{{$prodi['gdrive']}}" target="_blank"><img src="../assets/img/gdrive.jpg"  style="height:25px;object-fit:cover;"></a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Mata Kuliah</h4>
                </div>
                <div class="card-body">
                <div class="panel-group" id="listSemester">
                    @foreach($mata_kuliah as $semester => $list_mata_kuliah)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <h4 class="panel-title">
                                        <div class="col-xs-6">
                                            <a data-toggle="collapse" data-parent="#listSemester"
                                            href="#semester{{$semester}}">Semester {{ $semester }}</a>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <span>Total SKS: {{ array_sum(array_map(function($mata_kuliah) {
                                                return $mata_kuliah['sks'];
                                            }, $list_mata_kuliah)) }} SKS</span>
                                        </div>
                                    </h4>
                                </div>
                            </div>
                            <div class="panel-collapse collapse" id="semester{{$semester}}">
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Kode MK</th>
                                                <th rowspan="2">Nama</th>
                                                <th rowspan="2">SKS</th>
                                                <th colspan="2">Prasyarat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($list_mata_kuliah as $mata_kuliah)
                                                <tr>
                                                    <td>{{ $mata_kuliah['id'] }}</td>
                                                    <td>{{ $mata_kuliah['nama'] }} @if (array_key_exists($mata_kuliah['id'], MATAKULIAH)==1) <a href="{{MATAKULIAH[$mata_kuliah['id']]}}" target=_blank> <img src="../assets/img/glogo.jpg"></a> @endif</td>
                                                    <td>{{ $mata_kuliah['sks'] }}</td>
                                                    <td>
                                                        <ol>
                                                            @foreach($mata_kuliah['prasyarat'] as $prasyarat)
                                                                <li>
                                                                    ({{ $prasyarat['id'] }}) {{ $prasyarat['nama'] }}
                                                                </li>
                                                            @endforeach
                                                        </ol>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Presentase Domain</h4>
                </div>
                <div class="card-body" style="margin-top:40px">
                    @php
                    $color = [
                        '#6200EA',
                        '#D50000',
                        '#AA00FF',
                        '#FFAB00',
                        '#80DEEA',
                        '#6200EA',
                    ];
                    @endphp
                    @include('widgets.charts.cpiechart_sdm_domain', [
                        'data' => $data_domain,
                        'color' => $color,
                    ])
                </div>
                <div class="card-body" style="margin-top:40px">
                    @foreach($data_domain as $i => $domain)
                        <p><span class="dot" style="background-color:{!! $color[$i] !!}"></span>{{$domain['domain']}} : {{$domain['persen']}}%</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop
