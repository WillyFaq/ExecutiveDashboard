<div class="card mb-3">
    <div class="card-header flushed">
        <h2 class="page-title">Nilai SDM</h2>
        <p class="chart-subtitle">Minimum :  3.50</p>
    </div>
    <div class="card-body">
        @include('widgets.charts.gauge_sdm', array('value' => number_format($skor_nilai_sdm,2)))
    </div>
    <div class="card-footer flushed">
        <div class="text-center">
            <div class="chart-subtitle d-inline-block">
                <div class="mx-1 legend-block d-inline-block bg-primary"></div>
                Sangat Baik
            </div>
            <div class="chart-subtitle d-inline-block">
                <div class="mx-1 legend-block d-inline-block bg-success"></div>
                Baik
            </div>
            <div class="chart-subtitle d-inline-block">
                <div class="mx-1 legend-block d-inline-block bg-warning"></div>
                Sedang
            </div>
            <div class="chart-subtitle d-inline-block">
                <div class="mx-1 legend-block d-inline-block bg-danger"></div>
                Buruk
            </div>
        </div>
    </div>
</div>
