@php
    if($skor_penelitian <= 1){
        $class_name = "danger";
    }elseif($skor_penelitian <= 2){
        $class_name = "warning";
    }elseif($skor_penelitian <= 3){
        $class_name = "success";
    }else{
        $class_name = "primary";
    }
@endphp
<div class="card mb-2">
    <div class="card-body p-1">
        <div class="d-inline-block">
            <p class="d-block chart-title small mb-1">{{$judul['180406']}}</p>
            <div class="d-flex">
                <div style="width:184px;">
                    @include('widgets.charts.areachart_gradient', [
                        'color' => "default", 
                        'data' => array_combine($periode_ewmp, $jml_penelitian_dosen),
                    ])
                </div>
                <div style="width:195px;" class="pl-1 pb-1">
                    <div class="d-inline-block text-center mr-1">
                        <p class="mb-0 data-value text-info">{{array_sum(array_values($jml_penelitian_dosen))}}</p>
                        <p class="pb-0">Nasional</p>
                    </div>
                    <div class="d-inline-block text-center">
                        <p class="mb-0 data-value text-{{$class_name}}">{{0}}<span style="font-size:12px">/{{ceil($jml_dosen_tetap*0.3)}}</span></p>
                        <p class="pb-0">Internasional</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-inline-block rounded-right text-center bg-{{$class_name}} skor-panel d-table" style="padding-left:8px; padding-right:8px; position:absolute; top:0; right:0; height:142px">
            <div class="d-table-cell align-middle">
                <p class="chart-subtitle">Skor</p>
                <h1 class="data-value small">{{number_format($skor_penelitian,2)}}</h1>
            </div>
        </div>
    </div>
</div>
