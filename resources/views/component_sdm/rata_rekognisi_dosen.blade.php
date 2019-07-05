@php
    if($skor_rekognisi <= 1){
        $class_name = "danger";
    }elseif($skor_rekognisi <= 2){
        $class_name = "warning";
    }elseif($skor_rekognisi <= 3){
        $class_name = "success";
    }else{
        $class_name = "primary";
    }
@endphp
<div class="card mb-2">
    <div class="card-body p-1">
        <div class="d-inline-block">
            <p class="d-block">{{$judul['180408']}}</p>
            <div class="d-flex">
                <div style="width:190px;">
                    @include('widgets.charts.areachart_gradient', [
                        'color' => "default", 
                        'data' => array_combine($periode_ewmp, $jml_rekognisi_dosen),
                    ])
                </div>
                <div style="width:195px;">
                    <div class="d-inline-block text-center">
                        <p class="mb-0 text-info">{{array_sum(array_values($jml_rekognisi_dosen))}}</p>
                        <p class="pb-0">Pengakuan</p>
                    </div>
                    <div class="d-inline-block text-center">
                        <p class="mb-0 text-{{$class_name}}">{{$jml_dosen_tetap}}</p>
                        <p class="pb-0">Dosen Tetap</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-inline-block ml-auto py-3 px-1 rounded-right text-center card-sdm-right bg-{{$class_name}} skor-panel" style="position:absolute; top:0; right:0; height:142px">
            <p class="chart-subtitle">Skor</p>
            <h1 class="data-value">{{number_format($skor_rekognisi,2)}}</h1>
        </div>
    </div>
</div>
