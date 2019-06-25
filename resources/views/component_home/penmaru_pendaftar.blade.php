<div class="card">
    <div class="card-header flushed pt-3 pl-3 pr-3 pb-0">
        <div class="d-flex">
            <img src="{{asset('imgs/person.svg')}}" class="card-icon mr-2">
            <div class="align-top">
                <p class="chart-title mb-0">Pendaftar</p>
                <p class="chart-subtitle mb-0">{{$periode}}</p>
            </div>
            <div class="ml-auto mr-1 text-right">
                @php
                    $persen_daftar = round((($daftar['total']/$daftar['total_lalu'])-1)*100,2);
                @endphp
                <i class="fa mb-2 {{$persen_daftar>=0?'fa-arrow-up':'fa-arrow-down'}}"></i>
                <p class="m-0 chart-subtitle {{$persen_daftar>=0?'text-primary':'text-danger'}}">
                    {{ abs($persen_daftar) }}%
                </p>
            </div>
            <div>
                <h4 class="m-0 data-value mb-1 {{$persen_daftar>=0?'text-parimary':'text-danger'}}">
                    {{$daftar['total']}}
                </h4>
                <p class="m-0 chart-subtitle">Pendafar</p>
            </div>
        </div>
    </div>
    <div class="card-body py-0 px-2">
        @include('widgets.charts.mixchart', array(
            'data' => $daftar,
            'id_legend' => 'legend-pendaftar',
        ))
    </div>
    <div class="card-footer flushed" id="legend-pendaftar"></div>
</div>
