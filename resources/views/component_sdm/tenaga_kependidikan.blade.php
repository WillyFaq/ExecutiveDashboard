@php
    if($skor_tenaga_kependidikan <= 1){
        $class_name = "danger";
    }elseif($skor_tenaga_kependidikan <= 2){
        $class_name = "warning";
    }elseif($skor_tenaga_kependidikan <= 3){
        $class_name = "success";
    }else{
        $class_name = "primary";
    }
@endphp
<div class="card mb-2">
    <div class="row">
        <div class="col-8">
            <div class="card-header flushed pb-0">
                <p class="chart-title mb-0">{{$judul['180409']}}</p>
            </div>
            <div class="card-body">
                @for($i=1; $i <= 4; $i++)
                    @if($i <= $skor_tenaga_kependidikan)
                        <i class="mr-3 d-inline-block data-value large fac fa-star text-{{$class_name}}"></i>
                    @else
                        <i class="mr-3 d-inline-block data-value large fac fa-star text-muted"></i>
                    @endif
                @endfor
            </div>
        </div>
        <div class="col-4 py-2 mx-auto">
            @include('widgets.charts.gauge', [
                'skor'=> number_format($skor_tenaga_kependidikan,2), 
                'type' => 2,
                'class_name' => $class_name,
            ])
        </div>
    </div>
</div>
