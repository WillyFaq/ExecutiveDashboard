@php
    if($skor_presentase_dosen_tidak_tetap <= 1){
        $class_name = "danger";
    }elseif($skor_presentase_dosen_tidak_tetap <= 2){
        $class_name = "warning";
    }elseif($skor_presentase_dosen_tidak_tetap <= 3){
        $class_name = "success";
    }else{
        $class_name = "primary";
    }
@endphp
<div class="card mb-2">
    <div class="card-header flushed pb-0">
        <div class="d-flex">
            <div class="align-top">
                <p class="chart-title mb-0">{{$judul['180404']}}</p>
                <p class="chart-subtitle mb-0">{{ $periode }}</p>
            </div>
            <div class="ml-auto text-center rounded-top-right bg-{{$class_name}} px-2 skor-panel" style="padding-top:8px; padding-bottom:10px; margin-top:-20px; margin-right:-30px">
                <p class="chart-subtitle mb-0">Skor</p>
                <p class="data-value medium mb-0">{{ number_format($skor_presentase_dosen_tidak_tetap,2) }}</p>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('widgets.charts.cpiechart', [
            'data' => [
                'Dosen Tetap' => $jml_dosen_tetap,
                'Dosen Tidak Tetap' => $jml_dosen_tidak_tetap,
            ],
            'id_legend' => 'legend-dosen',
        ])
    </div>
    <div class="card-footer flushed">
        <div class="text-left" id="legend-dosen"></div>
    </div>
</div>
