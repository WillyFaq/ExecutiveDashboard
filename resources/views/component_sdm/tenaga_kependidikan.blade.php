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
    <div class="card-body">
        <div class="row">
            <div class="col-9">
                <p class="chart-title">Tenaga Kependidikan</p>
                <div class="star-box">
                    @for($i=1; $i <= 4; $i++)
                        @if($i <= $skor_tenaga_kependidikan)
                            <i class="mr-1 fac fa-star text-{{$class_name}}"></i>
                        @else
                            <i class="mr-1 fac fa-star text-muted"></i>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="col-3">
                @include('widgets.charts.gauge', [
                    'skor'=> number_format($skor_tenaga_kependidikan,2), 
                    'type' => 2,
                    'class_name' => $class_name,
                ])
            </div>
        </div>
    </div>
</div>
