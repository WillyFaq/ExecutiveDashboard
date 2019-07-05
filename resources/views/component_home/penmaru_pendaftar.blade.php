<div class="card">
    <div class="card-header flushed pb-0">
        <div class="d-flex">
            <img src="{{asset('imgs/person.svg')}}" class="card-icon mr-1">
            <div class="align-top">
                <p class="chart-title mb-0">Pendaftar</p>
                <p class="chart-subtitle mb-0">{{$periode}}</p>
            </div>
            <div class="ml-auto mr-1 text-center">
                @php
                    $persen_daftar = round((($daftar['total']/$daftar['total_lalu'])-1)*100,2);
                @endphp
                <i class="fac {{$persen_daftar>=0?'fa-arrow-up-thin text-primary':'fa-arrow-down-thin text-danger'}} data-value"></i>
                <p class="m-0 chart-subtitle {{$persen_daftar>=0?'text-primary':'text-danger'}}">
                    {{ abs($persen_daftar) }}%
                </p>
            </div>
            <div class="text-center">
                <h4 class="m-0 data-value {{$persen_daftar>=0?'text-parimary':'text-danger'}}">
                    {{$daftar['total']}}
                </h4>
                <p class="m-0 chart-subtitle">Pendafar</p>
            </div>
        </div>
    </div>
    <div class="card-body px-2 pt-1 pb-0">
        @include('widgets.charts.mixchart', array(
            'data' => $daftar,
            'id_legend' => 'legend-pendaftar',
        ))
    </div>
    <div class="card-footer flushed pt-0 text-center" id="legend-pendaftar"></div>
</div>
