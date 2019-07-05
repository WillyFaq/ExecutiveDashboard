@php
    if($skor_sertifikat_pendidikan <= 1){
        $class_name = "danger";
    }elseif($skor_sertifikat_pendidikan <= 2){
        $class_name = "warning";
    }elseif($skor_sertifikat_pendidikan <= 3){
        $class_name = "success";
    }else{
        $class_name = "primary";
    }
@endphp
<div class="card mb-3">
    <div class="card-header pb-0">
        <div class="d-flex">
            <div class="align-top">
                <p class="chart-title mb-0">Persentase Sertifikat Pendidikan</p>
                <p class="chart-subtitle mb-0">{{$periode}}</p>
            </div>
            <div class="d-inline-block ml-auto mr-3" id="legend-sertifikasi"></div>
            <div class="text-center rounded-top-right bg-{{$class_name}} py-1 px-2 skor-panel" style="margin:-15px -20px 0 0;">
                <p class="chart-subtitle mb-0">Skor</p>
                <p class="data-value mb-0">{{number_format($skor_sertifikat_pendidikan,2)}}</p>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('widgets.charts.mixchart_sdm', [
            'data' => [
                'line' => ['Sertifikasi', $dosen_tetap_bersertifikasi],
                'bar'	=> ['Dosen Tetap', $dosen_tetap ],
            ],
            'onClickFn' => 'show_modal_sertifikasi',
            'id_legend' => 'legend-sertifikasi',
        ])
    </div>
</div>
