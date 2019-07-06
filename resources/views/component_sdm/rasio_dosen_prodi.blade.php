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
    <div class="row">
        <div class="col-8">
            <div class="card-header flushed pb-0">
                <p class="chart-title mb-0">{{$judul['180401']}}</p>
            </div>
            <div class="card-body">
                <p class="data-value extra-large mb-0 text-{{$class_name}}">1 : {{$rasio_prodi_dosen}}</p>
            </div>
        </div>
        <div class="col-4 py-2 mx-auto">
            @include('widgets.charts.gauge', [
                'skor'=> number_format($skor_rasio_prodi_dosen,2), 
                'type' => 2 ,
                'class_name' => $class_name,
            ])
        </div>
    </div>
</div>
