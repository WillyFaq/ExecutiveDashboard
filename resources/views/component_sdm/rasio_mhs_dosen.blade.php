@php
    if($skor_rasio_dosen_mahasiswa <= 1){
        $class_name = "danger";
    }elseif($skor_rasio_dosen_mahasiswa <= 2){
        $class_name = "warning";
    }elseif($skor_rasio_dosen_mahasiswa <= 3){
        $class_name = "success";
    }else{
        $class_name = "primary";
    }
@endphp
<div class="card mb-2">
    <div class="card-body">
        <div class="row">
            <div class="col-9">
                <p class="chart-title">Rasio Dosen : Mahasiswa</p>
                <p class="data-value text-{{$class_name}}">1 : {{$rasio_dosen_mahasiswa}}</p>
            </div>
            <div class="col-3">
                @include('widgets.charts.gauge', [
                    'skor'=> number_format($skor_rasio_dosen_mahasiswa,2), 
                    'type' => 2 ,
                ])
            </div>
        </div>
    </div>
</div>
