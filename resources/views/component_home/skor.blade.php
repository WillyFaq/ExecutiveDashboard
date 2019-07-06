<style>
    #panel-skor .nama-pt {
        font-size: 22px;
        font-weight: bold;
        color: black;
        line-height: 26px;
        margin-bottom: 5px;
    }
    #panel-skor .alert {
        height: 273px;
    }
    #panel-skor .detail-pt {
        font-size: 16px;
        line-height: 20px;
        margin-bottom: 5px;
    }
    #panel-skor .skor-desc p {
        color: white;
        font-size: 18px;
        margin-bottom: 0;
    }
    #panel-skor .skor-desc p.value {
        font-weight: bold;
        font-size: 32px;
    }
    #panel-skor .bg-primary {
        background: #00F2FE;
        background: -moz-linear-gradient(117deg, #00F2FE 0%, #4FACFE 100%);
        background: -webkit-gradient(117deg, right bottom, color-stop(0%, #00F2FE), color-stop(100%, #4FACFE));
        background: -webkit-linear-gradient(117deg, #00F2FE 0%, #4FACFE 100%);
        background: -o-linear-gradient(117deg, #00F2FE 0%, #4FACFE 100%);
        background: -ms-linear-gradient(117deg, #00F2FE 0%, #4FACFE 100%);
        background: linear-gradient(117deg, #00F2FE 0%, #4FACFE 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00F2FE', endColorstr='#4FACFE', GradientType=1 );
    }
    #panel-skor .bg-success {
        background: #FF527A;
        background: -moz-linear-gradient(117deg, #FF527A 0%, #26D1FE 100%);
        background: -webkit-gradient(117deg, right bottom, color-stop(0%, #FF527A), color-stop(100%, #26D1FE));
        background: -webkit-linear-gradient(117deg, #FF527A 0%, #26D1FE 100%);
        background: -o-linear-gradient(117deg, #FF527A 0%, #26D1FE 100%);
        background: -ms-linear-gradient(117deg, #FF527A 0%, #26D1FE 100%);
        background: linear-gradient(117deg, #FF527A 0%, #26D1FE 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff527a', endColorstr='#26cffe', GradientType=1 );
    }
    #panel-skor .bg-warning {
        background: #FF9575;
        background: -moz-linear-gradient(117deg, #FF9575 0%, #FE8C00 100%);
        background: -webkit-gradient(117deg, right bottom, color-stop(0%, #FF9575), color-stop(100%, #FE8C00));
        background: -webkit-linear-gradient(117deg, #FF9575 0%, #FE8C00 100%);
        background: -o-linear-gradient(117deg, #FF9575 0%, #FE8C00 100%);
        background: -ms-linear-gradient(117deg, #FF9575 0%, #FE8C00 100%);
        background: linear-gradient(117deg, #FF9575 0%, #FE8C00 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff527a', endColorstr='#26cffe', GradientType=1 );
    }
    #panel-skor .bg-danger {
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
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.14);
    }
</style>
<div id="panel-skor" class="card mb-2">
    <div class="card-header flushed pb-1">
        <div class="d-flex">
            <img class="rounded-circle" src="{{asset('imgs/stikom.jpg')}}" alt="Stikom" style="height:105px;width:105px;">
            <div class="align-top ml-2">
                <h3 class="nama-pt">Institut Bisnis dan Informatika Stikom Surabaya</h3>
                <h5 class="detail-pt">Jl. Raya Kedung Baruk Nomor 98</h5>
                <h5 class="detail-pt">(031) 8721731</h5>
            </div>
        </div>
    </div>
    @php
    if($skor['nilai'] < 200){
        $status = 'danger';
    }elseif($skor['nilai'] < 300){
        $status = 'warning';
    }elseif($skor['nilai'] < 360){
        $status = 'success';
    }else{
        $status = 'primary';
    }
    @endphp
    <div class="card-body pt-1 pb-5">
        <div class="alert mb-0 bg-{{$status}}">
            <div class="row">
                <div class="col pt-2">
                    @php
                        $skor['chart']['status'] = $status
                    @endphp
                    @include('widgets.charts.gauge_home', $skor['chart'])
                </div>
                <div class="col skor-desc pt-4">
                    <p>Status</p>
                    <p class="value pb-2">
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
        <div class="card-bubble" style="bottom:45px; right:-5px;"></div>
        <div class="card-bubble" style="bottom:0px; right:20px;"></div>
    </div>
</div>
