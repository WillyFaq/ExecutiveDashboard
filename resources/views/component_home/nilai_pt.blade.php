<style>
.sts-apt-line {
    border: 1px dashed #F1C40F;
}
.nil-pt-line {
    border: 1px solid #1ABC9C;
}
.line-txt {
    width: 50px;
    height: 1px;
    margin-top: 5px
}
.legend-text{
    font-size: 14px;
}
</style>
<div class="card">
    <div class="card-header flushed pb-0">
        <img src="{{asset('imgs/chart.svg')}}" class="card-icon float-left mr-1">
        <span class="chart-title float-left mr-2">Nilai Perguruan Tinggi</span>
        <form class="form-inline">
            <div class="form-group mr-2">
                <div class="input-group input-group-sm">
                    <select id="tahun_mulai" class="form-control">
                        @foreach($list_tahun as $i=>$tahun)
                            <option value="{{$tahun}}" {{$i==0?'selected':''}}>{{$tahun}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <span class="input-group-text border-left-0">s/d</span>
                    </div>
                    <select id="tahun_selesai" class="form-control">
                        @foreach($list_tahun as $i=>$tahun)
                            <option value="{{$tahun}}" {{$i==count($list_tahun)-1?'selected':''}}>{{$tahun}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="nilai-pt-legend" class="ml-auto">
                <div class="row">
                    <div class="col">
                        <div class="line-txt sts-apt-line mr-3 float-left"></div>
                        <span class="legend-text float-left">Status APT</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="line-txt nil-pt-line mr-3 float-left"></div>
                        <span class="legend-text float-left">Nilai PT</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body px-2">
        @include('widgets.charts.linechart_home',[
            'id_tahun_mulai' => 'tahun_mulai',
            'id_tahun_selesai' => 'tahun_selesai',
        ])
    </div>
</div>
