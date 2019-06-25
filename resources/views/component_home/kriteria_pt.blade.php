<style>
#kriteria-pt .sub-card {
    position: absolute;
}
#kriteria-pt .sub-card.top {
    margin-top: 10px;
    top: 0;
}
#kriteria-pt .sub-card.bottom {
    margin-bottom: 10px;
    bottom: 0;
}
#kriteria-pt .sub-card.right {
    margin-right: 20px;
    right: 0;
    text-align: right;
}
#kriteria-pt .sub-card.left {
    margin-left: 20px;
    left: 0;
    text-align: left;
}
#kriteria-pt .data-label{
    font-size: 12px;
    margin-bottom: 0;
    color: black;
    font-weight: bolder;
}
#kriteria-pt .data-value{
    font-size: 24px;
    margin-bottom: 0;
}
#kriteria-pt .left .data-value i,
#kriteria-pt .left .data-value span{
    float: left;
}
#kriteria-pt .right .data-value i,
#kriteria-pt .right .data-value span{
    float: right;
}
</style>
<div class="card" id="kriteria-pt">
    <div class="card-header flushed pb-0">
        <img src="{{asset('imgs/copy.svg')}}" class="card-icon pull-left mr-2"> 
        <div class="pull-left">
            <p class="chart-title mb-0">Kriteria Perguruan Tinggi</p>
            <p class="chart-subtitle mb-0">{{$periode}}</p>
        </div>
    </div>
    <div class="card-body pt-0">
        @include('widgets.charts.radarchart', ['class'=>'pg_info'])
        <div class="sub-card kondisi_ekternal top right">
            <p class="data-label">{{$data_profil_0['kondisi_ekternal']['nama']}}</p>
            <p class="data-value {{$data_profil_0['kondisi_ekternal']['nilai']<2.7?'text-danger':'text-primary'}}">
                <span>{{$data_profil_0['kondisi_ekternal']['nilai']}}</span>
                <i class="fa fa-arrow-up mt-1"></i>
            </p>
        </div>
        <div class="sub-card profil_institusi bottom left">
            <p class="data-label">{{$data_profil_0['profil_institusi']['nama']}}</p>
            <p class="data-value {{$data_profil_0['profil_institusi']['nilai']<2.7?'text-danger':'text-primary'}}">
                <i class="fa fa-arrow-up mt-1"></i>
                <span>{{$data_profil_0['profil_institusi']['nilai']}}</span>
            </p>
        </div>
        <div class="sub-card pengembangan bottom right">
            <p class="data-label">{{$data_profil_0['pengembangan']['nama']}}</p>
            <p class="data-value {{$data_profil_0['pengembangan']['nilai']<2.7?'text-danger':'text-primary'}}">
                <span>{{$data_profil_0['pengembangan']['nilai']}}</span>
                <i class="fa fa-arrow-up mt-1"></i>
            </p>
        </div>
    </div>
</div>
