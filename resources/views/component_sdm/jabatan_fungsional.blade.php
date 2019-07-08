@php
    if($skor_jabatan_fungsional <= 1){
        $class_name = "danger";
    }elseif($skor_jabatan_fungsional <= 2){
        $class_name = "warning";
    }elseif($skor_jabatan_fungsional <= 3){
        $class_name = "success";
    }else{
        $class_name = "primary";
    }
@endphp
<div class="card mb-2">
    <div class="card-header flushed pb-0">
        <div class="d-flex">
            <div class="align-top">
                <p class="chart-title mb-0">{{$judul['180402']}}</p>
                <p class="chart-subtitle mb-0">{{ $periode }}</p>
            </div>
            <div class="d-inline-block ml-auto mr-3" id="legend-jafung"></div>
            <div class="text-center rounded-top-right bg-{{$class_name}} px-2 skor-panel" style="padding-top:8px; padding-bottom:10px; margin-top:-20px; margin-right:-30px">
                <p class="chart-subtitle mb-0">Skor</p>
                <p class="data-value medium mb-0">{{ number_format($skor_jabatan_fungsional,2) }}</p>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('widgets.charts.mixchart_sdm', [
            'data' => [
                'line'	=> ['Guru Besar', $dosen_guru_besar ],
                'bar'	=> ['Dosen Tetap', $dosen_tetap ],
                'line_target' => ['Target', $target_dosen_guru_besar],
            ],
            'onClickFn' => 'show_modal_jafung',
            'id_legend' => 'legend-jafung',
            'data_labels' => [
                'line' => [
                    'display' => true,
                    'anchor' => 'center',
                    'align' => 'center',
                    'color' => 'white',
                ],
                'bar' => [
                    'display' => true,
                    'anchor' => 'end',
                    'align' => 'end',
                ],
                'line_target' => [
                    'display' => false,
                ]
            ],
        ])
    </div>
</div>
