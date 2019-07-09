<style>
.sts-apt-line {
    border: 1px dashed #F1C40F;
}
.nil-pt-line {
    border: 1px solid #1ABC9C;
}
#tahun_mulai, #tahun_selesai{
    border:none;
    -moz-appearance: none;
    -webkit-appearance: none;
    padding:0 5px; 
    margin:0;
}

#tahun_mulai::-ms-expand , #tahun_selesai::-ms-expand {
    display: none;
}
</style>
<div class="card mb-2">
    <div class="card-header flushed">
        <div class="d-flex justify-content-between">
            <div class="media">
                <img src="{{asset('imgs/chart.svg')}}" class="card-icon mr-1">
                <div class="media-body chart-title">
                    Nilai Perguruan Tinggi
                    <div class="d-inline-block home-cbtahunpt" style="margin-left:5px">
                        <div class="input-group input-group-sm">
                            <select id="tahun_mulai" class="form-control">
                                @foreach($list_tahun as $i=>$tahun)
                                    <option value="{{$tahun}}" {{$i==0?'selected':''}}>{{$tahun}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-prepend"> - </div>
                            <select id="tahun_selesai" class="form-control">
                                @foreach($list_tahun as $i=>$tahun)
                                    <option value="{{$tahun}}" {{$i==count($list_tahun)-1?'selected':''}}>{{$tahun}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="nilai-pt-legend" class="text-right"></div>
        </div>
    </div>
    <div class="card-body pt-1 px-2">
        @include('widgets.charts.linechart_home',[
            'id_tahun_mulai' => 'tahun_mulai',
            'id_tahun_selesai' => 'tahun_selesai',
            'id_legend' => 'nilai-pt-legend',
        ])
    </div>
</div>
