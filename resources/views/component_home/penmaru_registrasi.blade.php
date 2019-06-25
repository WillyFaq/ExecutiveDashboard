<div class="card">
    <div class="card-header flushed pt-3 pl-3 pr-3 pb-0">
        <div class="d-flex">
            <img src="{{asset('imgs/group.svg')}}" class="card-icon mr-2">
            <div class="align-top">
                <p class="chart-title mb-0">Registrasi</p>
                <p class="chart-subtitle mb-0">{{$periode}}</p>
            </div>
            <div class="ml-auto mr-1 text-right">
                @php
                    $persen_regis = round((($regis['total']/$regis['total_lalu'])-1)*100,2);
                @endphp
                <i class="fa mb-2 {{$persen_regis>=0?'fa-arrow-up':'fa-arrow-down'}}"></i>
                <p class="m-0 chart-subtitle {{$persen_regis>=0?'text-primary':'text-danger'}}">
                    {{ abs($persen_regis) }}%
                </p>
            </div>
            <div>
                <h4 class="m-0 data-value mb-1 {{$persen_regis>=0?'text-parimary':'text-danger'}}">
                    {{$daftar['total']}}
                </h4>
                <p class="m-0 chart-subtitle">Register</p>
            </div>
        </div>
    </div>
    <div class="card-body py-0 px-2">
        @include('widgets.charts.barhorizontalchart', array(
            'data' => $regis,
            'id_legend' => 'legend-register',
        ))
    </div>
    <div class="card-footer flushed" id="legend-register"></div>
</div>
