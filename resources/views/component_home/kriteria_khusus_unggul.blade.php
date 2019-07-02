<style>
#kriteria-khusus .data-value {
    font-size: 14px;
}
#kriteria-khusus .data-value .current {
    font-weight: bold;
    color: black;
}
#kriteria-khusus .data-label {
    font-size: 14px;
    color: black;
}
</style>
<div class="card" id="kriteria-khusus">
    <div class="card-header flushed pb-2">
        <img src="{{asset('imgs/check.svg')}}" class="card-icon float-left mr-1">
        <div class="float-left">
            <p class="chart-title mb-0">Kriteria Khusus Unggul</p>
            <p class="chart-subtitle mb-0">{{$periode}}</p>
        </div>
    </div>
    <div class="list-group list-group-flush">
        @foreach($kriteria_khusus as $kk => $row)
            <div class="list-group-item border-0 pb-2 pt-0">
                <div class="mb-0">
                    <span class="data-label">{{$row[0]}}</span>
                    <span class="float-right data-value">
                        <span class="current">{{number_format($row[1], 2)}}</span>/4.00
                    </span>
                </div>
                @php
                    if($row[1] <= 1){
                        $class_name = "bg-danger";
                    }elseif($row[1] <= 2){
                        $class_name = "bg-warning";
                    }elseif($row[1] <= 3){
                        $class_name = "bg-success";
                    }else{
                        $class_name = "bg-primary";
                    }
                @endphp
                @include('widgets.progress', [
                    'class' => $class_name, 
                    'value' => $row[1]*100/4, 
                ])
            </div>
        @endforeach
    </div>
</div>
