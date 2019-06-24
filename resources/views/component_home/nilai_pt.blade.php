<style>
.sts-apt-line {
    border: 1px dashed #FE8C00;
}
.nil-pt-line {
    border: 1px solid #BE1E2D;
}
.line-txt {
    width: 50px;
    height: 1px;
    margin-top: 5px
}
.legend-text{
    font-size: 10px;
}
</style>
<div class="card">
    <div class="card-header flushed pt-3 pl-3 pr-3 pb-0">
        <form class="form-inline">
            <div class="form-group mr-2">
                <span class="chart-title">
                    <img src="{{asset('imgs/chart.svg')}}" class="card-icon mr-1"> Nilai Perguruan Tinggi
                </span>
            </div>
            <div class="form-group mr-2">
                <div class="input-group input-group-sm">
                    <select class="form-control">
                        @foreach($list_tahun as $i=>$tahun)
                            <option value="{{$tahun}}" {{$i==0?'selected':''}}>{{$tahun}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <span class="input-group-text border-left-0">s/d</span>
                    </div>
                    <select class="form-control">
                        @foreach($list_tahun as $i=>$tahun)
                            <option value="{{$tahun}}" {{$i==count($list_tahun)-1?'selected':''}}>{{$tahun}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="nilai-pt-legend" class="ml-auto">
                <div class="row">
                    <div class="col">
                        <div class="line-txt sts-apt-line mr-3 pull-left"></div>
                        <span class="legend-text pull-left">Status APT</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="line-txt nil-pt-line mr-3 pull-left"></div>
                        <span class="legend-text pull-left">Nilai PT</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        @include('widgets.charts.linechart_home',[
            'id_tahun_mulai' => 'tahun_mulai',
            'id_tahun_selesai' => 'tahun_selesai',
        ])
    </div>
</div>
