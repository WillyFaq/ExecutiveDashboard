@extends('layouts.dashboard')
@section('page_heading','SDM')
@section('section')

<div class="container container-main container-home" style="padding-top:10px;">
    <div class="row">
        <div class="col">
            @foreach($prodi as $i => $prodi)
                @if($i % 3 == 0)
                    <div class="row main-dash">
                @endif
                <div class="col col-xs-4">
                    <div class="card" style="height:205px">
                        <div class="card-header">
                            <h6 class="card-title">{{ $prodi['fakultas'] }}</h6>
                            <h4 class="card-title"><strong>
                                <a href="{!! url('pendidikan/'.$prodi['kode']) !!}">{{ $prodi['nama'] }}</a>
                            </strong></h4>
                        </div>
                        <div class="card-body">
                            <h5><strong>Profil Lulusan</strong></h5>
                            <div class="row">
                                @if(count($prodi['profil']) > 3)
                                <div class="col-xs-6">
                                @else
                                <div class="col-xs-12">
                                @endif
                                    <ol style="padding-left:20px">
                                    @for($j = 0; $j < 3; $j++)
                                        <li>{{ $prodi['profil'][$j] }}</li>
                                    @endfor
                                    </ol>
                                </div>
                                @if(count($prodi['profil']) > 3)
                                    <div class="col-xs-6">
                                        <ol style="padding-left:20px" start="4">
                                        @for($j; $j < count($prodi['profil']); $j++)
                                            <li>{{ $prodi['profil'][$j] }}</li>
                                        @endfor
                                        </ol>
                                    </div>
                                @endif
                                
                            </div>
                            <a href="{{$prodi['gdrive']}}" target="_blank"><img src="assets/img/gdrive.jpg"  style="height:25px;object-fit:cover;"></a>
                        </div>
                    </div>
                </div>
                @if(($i+1) % 3 == 0)
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@stop
