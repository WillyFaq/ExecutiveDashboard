<style>
    #panel-skor .nama-pt {
        font-size: 14pt;
        font-weight: bold;
        color: black;
        line-height: 20px;
    }
    #panel-skor .detail-pt {
        font-size: 13px;
    }
    #panel-skor .color-panel{
        min-height: 175px;
    }
    #panel-skor .skor-desc p {
        color: white;
        font-size: 13pt;
        margin-bottom: 0;
    }
    #panel-skor .skor-desc p.value {
        font-weight: bold;
        font-size: 18pt;
    }
    #home-panel-skor.unggul {
        background: #00F2FE;
        background: -moz-linear-gradient(117deg, #00F2FE 0%, #4FACFE 100%);
        background: -webkit-gradient(117deg, right bottom, color-stop(0%, #00F2FE), color-stop(100%, #4FACFE));
        background: -webkit-linear-gradient(117deg, #00F2FE 0%, #4FACFE 100%);
        background: -o-linear-gradient(117deg, #00F2FE 0%, #4FACFE 100%);
        background: -ms-linear-gradient(117deg, #00F2FE 0%, #4FACFE 100%);
        background: linear-gradient(117deg, #00F2FE 0%, #4FACFE 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff527a', endColorstr='#26cffe', GradientType=1 );
    }
    #panel-skor .card.baik_sekali {
        background: #FF527A;
        background: -moz-linear-gradient(117deg, #FF527A 0%, #26D1FE 100%);
        background: -webkit-gradient(117deg, right bottom, color-stop(0%, #FF527A), color-stop(100%, #26D1FE));
        background: -webkit-linear-gradient(117deg, #FF527A 0%, #26D1FE 100%);
        background: -o-linear-gradient(117deg, #FF527A 0%, #26D1FE 100%);
        background: -ms-linear-gradient(117deg, #FF527A 0%, #26D1FE 100%);
        background: linear-gradient(117deg, #FF527A 0%, #26D1FE 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff527a', endColorstr='#26cffe', GradientType=1 );
    }
    #panel-skor .card.baik {
        background: #FF9575;
        background: -moz-linear-gradient(117deg, #FF9575 0%, #FE8C00 100%);
        background: -webkit-gradient(117deg, right bottom, color-stop(0%, #FF9575), color-stop(100%, #FE8C00));
        background: -webkit-linear-gradient(117deg, #FF9575 0%, #FE8C00 100%);
        background: -o-linear-gradient(117deg, #FF9575 0%, #FE8C00 100%);
        background: -ms-linear-gradient(117deg, #FF9575 0%, #FE8C00 100%);
        background: linear-gradient(117deg, #FF9575 0%, #FE8C00 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff527a', endColorstr='#26cffe', GradientType=1 );
    }
    #panel-skor .card.tidak_terakreditasi {
        background: #FF527A;
        background: -moz-linear-gradient(117deg, #FF527A 0%, #FF9575 100%);
        background: -webkit-gradient(117deg, right bottom, color-stop(0%, #FF527A), color-stop(100%, #FF9575));
        background: -webkit-linear-gradient(117deg, #FF527A 0%, #FF9575 100%);
        background: -o-linear-gradient(117deg, #FF527A 0%, #FF9575 100%);
        background: -ms-linear-gradient(117deg, #FF527A 0%, #FF9575 100%);
        background: linear-gradient(117deg, #FF527A 0%, #FF9575 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff527a', endColorstr='#26cffe', GradientType=1 );
    }
    #panel-skor .card-bubble{
        position: absolute;
        width: 58.96px;
        height: 58.96px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.14);
    }
</style>
<div id="panel-skor" class="card">
    <div class="card-body pb-0">
        <div class="row">
            <div class="col-md-3">
                <img class="rounded-circle" src="{{asset('imgs/stikom.jpg')}}" alt="Stikom" style="height:80px;width:80px;">
            </div>
            <div class="col">
                <p class="d-block d-md-none"><!-- LOWER VIEWPOINT SPACE --></p>
                <p class="nama-pt mb-2">Institut Bisnis dan Informatika Stikom Surabaya</p>
                <p class="detail-pt">Jl. Raya Kedung Baruk No.<br/>(031) 8721731</p>
            </div>
        </div>
    </div>
    @php
    if($skor['nilai'] < 200){
        $status = 'tidak_terakreditasi';
    }elseif($skor['nilai'] < 300){
        $status = 'baik';
    }elseif($skor['nilai'] < 360){
        $status = 'baik_sekali';
    }else{
        $status = 'unggul';
    }
    @endphp
    <div class="card-body pt-0">
        <div class="card {{$status}} color-panel">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        @php
                            $skor['chart']['status'] = $status
                        @endphp
                        @include('widgets.charts.gauge_home', $skor['chart'])
                    </div>
                    <div class="col skor-desc">
                        <p>Status</p>
                        <p class="value">
                            @if($skor['nilai'] < 200)
                                Tidak Terakreditasi
                            @elseif($skor['nilai'] < 300)
                                Baik
                            @elseif($skor['nilai'] < 360)
                                Baik Sekali
                            @else
                                Unggul
                            @endif
                        </p>
                        <p>Nilai Saat ini</p>
                        <p class="value">{{$skor['nilai']}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-bubble" style="bottom:35px; right:-5px;"></div>
        <div class="card-bubble" style="bottom:0px; right:20px;"></div>
    </div>
</div>
