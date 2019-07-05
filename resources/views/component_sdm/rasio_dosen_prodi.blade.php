@php
    if($skor_rasio_prodi_dosen <= 1){
        $class_name = "danger";
    }elseif($skor_rasio_prodi_dosen <= 2){
        $class_name = "warning";
    }elseif($skor_rasio_prodi_dosen <= 3){
        $class_name = "success";
    }else{
        $class_name = "primary";
    }
@endphp
<div class="card mb-2">
    <div class="card-body">
        <div class="row">
            <div class="col-9">
                <p class="chart-title">Rasio Program Studi : Dosen</p>
                <p class="data-value text-{{$class_name}}">1 : {{$rasio_prodi_dosen}}</p>
            </div>
            <div class="col-3">
                @include('widgets.charts.gauge', [
                    'skor'=> number_format($skor_rasio_prodi_dosen,2), 
                    'type' => 2 ,
                    'class_name' => $class_name,
                ])
            </div>
        </div>
    </div>
</div>
