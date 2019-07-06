@php
    if($skor_pkm <= 1){
        $class_name = "danger";
    }elseif($skor_pkm <= 2){
        $class_name = "warning";
    }elseif($skor_pkm <= 3){
        $class_name = "success";
    }else{
        $class_name = "primary";
    }
@endphp
<div class="card mb-2">
    <div class="card-body p-1">
        <div class="d-inline-block">
            <p class="d-block">{{$judul['180407']}}</p>
            <div class="d-flex">
                <div style="width:190px;">
                    @include('widgets.charts.areachart_gradient', [
                        'color' => "default", 
                        'data' => array_combine($periode_ewmp, $jml_pkm_dosen),
                    ])
                </div>
                <div style="width:195px;">
                    <div class="d-inline-block text-center mr-1">
                        <p class="mb-0 text-info">{{array_sum(array_values($jml_pkm_dosen))}}</p>
                        <p class="pb-0">Nasional</p>
                    </div>
                    <div class="d-inline-block text-center">
                        <p class="mb-0 text-{{$class_name}}">{{0}}<span style="font-size:12px">/{{ceil($jml_dosen_tetap*0.15)}}</span></p>
                        <p class="pb-0">Internasional</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-inline-block ml-auto py-3 px-1 rounded-right text-center card-sdm-right bg-{{$class_name}} skor-panel" style="position:absolute; top:0; right:0; height:142px">
            <p class="chart-subtitle">Skor</p>
            <h1 class="data-value">{{number_format($skor_pkm,2)}}</h1>
        </div>
    </div>
</div>