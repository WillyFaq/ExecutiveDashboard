<style>
#kriteria-khusus .data-value {
    font-weight: bold;
    color: black;
}
#kriteria-khusus .data-label {
    font-size: 14px;
    color: black;
}
</style>
<div class="card" id="kriteria-khusus">
    <div class="card-header flushed pb-0">
        <form class="form-inline">
            <div class="form-group mr-2">
                <span class="chart-title">
                    <img src="{{asset('imgs/check.svg')}}" class="card-icon mr-1"> Kriteria Khusus Unggul
                </span>
            </div>
        </form>
    </div>
    <div class="list-group list-group-flush mt-3">
        @foreach($kriteria_khusus as $kk => $row)
            <div class="list-group-item border-0 pb-2 pt-0">
                <div class="mb-2">
                    <span class="data-label">{{$row[0]}}</span>
                    <span class="pull-right">
                        <span class="data-value">{{number_format($row[1], 2)}}</span>/4.00
                    </span>
                </div>
                @include('widgets.progress', [
                    'class' => $row[1] < 2.7 ? "bg-warning" : null, 
                    'value' => $row[1]*100/4, 
                ])
            </div>
        @endforeach
    </div>
</div>
