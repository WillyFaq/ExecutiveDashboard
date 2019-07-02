<style>
#kriteria-pt .sub-card {
    position: absolute;
}
#kriteria-pt .sub-card.top {
    top: 0;
}
#kriteria-pt .sub-card.bottom {
    bottom: 0;
}
#kriteria-pt .sub-card.right {
    right: 0;
}
#kriteria-pt .sub-card.left {
    left: 0;
}
#kriteria-pt .data-label{
    font-size: 12px;
    margin-bottom: 0;
    color: black;
    font-weight: bolder;
    text-align: center;
}
#kriteria-pt .data-value{
    font-size: 24px;
    margin-bottom: 0;
}
</style>
<div class="card" id="kriteria-pt">
    <div class="card-header flushed pb-0">
        <img src="{{asset('imgs/copy.svg')}}" class="card-icon float-left mr-1"> 
        <div class="float-left">
            <p class="chart-title mb-0">Kriteria Perguruan Tinggi</p>
            <p class="chart-subtitle mb-0">{{$periode}}</p>
        </div>
    </div>
    <div class="card-body pt-0">
        @include('widgets.charts.radarchart', ['class'=>'pg_info'])
        <div class="sub-card kondisi_ekternal top right mt-3 mr-3">
            <p class="data-label">{{$data_profil_0['kondisi_ekternal']['nama']}}</p>
            <p class="data-value {{$data_profil_0['kondisi_ekternal']['nilai']<2.7?'text-danger':'text-primary'}}">
                <i class="fac fa-arrow-up-thin"></i>
                <span>{{number_format($data_profil_0['kondisi_ekternal']['nilai'], 2)}}</span>
            </p>
        </div>
        <div class="sub-card profil_institusi bottom left mb-3 ml-3">
            <p class="data-label">{{$data_profil_0['profil_institusi']['nama']}}</p>
            <p class="data-value {{$data_profil_0['profil_institusi']['nilai']<2.7?'text-danger':'text-primary'}}">
                <i class="fac fa-arrow-up-thin"></i>
                <span>{{number_format($data_profil_0['profil_institusi']['nilai'], 2)}}</span>
            </p>
        </div>
        <div class="sub-card pengembangan bottom right mb-3 mr-3">
            <p class="data-label">{{$data_profil_0['pengembangan']['nama']}}</p>
            <p class="data-value {{$data_profil_0['pengembangan']['nilai']<2.7?'text-danger':'text-primary'}}">
                <i class="fac fa-arrow-up-thin"></i>
                <span>{{number_format($data_profil_0['pengembangan']['nilai'], 2)}}</span>
            </p>
        </div>
    </div>
</div>
