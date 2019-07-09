<style>
#kriteria-khusus .data-value {
    font-size: 16px;
    font-weight: normal;
}
#kriteria-khusus .data-value .current {
    font-weight: bold;
}
#kriteria-khusus .data-label {
    font-size: 16px;
    color: black;
}
</style>
<div class="card mb-2" id="kriteria-khusus">
    <div class="card-header flushed pb-2">
        <img src="{{asset('imgs/check.svg')}}" class="card-icon float-left mr-1">
        <div class="float-left">
            <p class="chart-title mb-0">Kriteria Khusus Unggul</p>
            <p class="chart-subtitle mb-0">{{$periode}}</p>
        </div>
    </div>
    <div class="list-group list-group-flush">
        @foreach($kriteria_khusus as $kk => $row)
            <div class="list-group-item border-0 pb-1 pt-0">
                @php
                    if($row[1] <= 1){
                        $class_name = "danger";
                    }elseif($row[1] <= 2){
                        $class_name = "warning";
                    }elseif($row[1] <= 3){
                        $class_name = "success";
                    }else{
                        $class_name = "primary";
                    }
                @endphp
                <div class="home-pgbar">
                    <span class="data-label">{{$row[0]}}</span>
                    <span class="float-right data-value">
                        <span class="current text-{{$class_name}}">{{number_format($row[1], 2)}}</span>/4.00
                    </span>
                </div>
                @include('widgets.progress', [
                    'class' => "bg-$class_name", 
                    'value' => $row[1]*100/4, 
                ])
            </div>
        @endforeach
    </div>
    <div class="card-body text-center home-legend-kriteriakhusus">
        <div class="mr-3 d-inline-block">
            <div class="mx-1 bg-primary legend-block d-inline-block"></div>
            <span class="legend-text text-dark">Sangat Baik</span>
        </div>
        <div class="mr-3 d-inline-block">
            <div class="mx-1 bg-success legend-block d-inline-block"></div>
            <span class="legend-text text-dark">Baik</span>
        </div>
        <div class="mr-3 d-inline-block">
            <div class="mx-1 bg-warning legend-block d-inline-block"></div>
            <span class="legend-text text-dark">Sedang</span>
        </div>
        <div class="mr-3 d-inline-block">
            <div class="mx-1 bg-danger legend-block d-inline-block"></div>
            <span class="legend-text text-dark">Buruk</span>
        </div>
    </div>
</div>
