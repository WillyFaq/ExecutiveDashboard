<div class="card mb-2">
    <div class="card-header flushed mb-2">
        <h2 class="page-title">Nilai SDM</h2>
    </div>
    <div class="card-body">
        @include('widgets.charts.gauge_sdm', array('value' => number_format($skor_nilai_sdm,2)))
    </div>
    <div class="card-footer flushed">
        <div class="text-center">
            <div class="d-inline-block" style="margin-right:10px;">
                <div class="legend-block d-inline-block bg-primary" style="margin-right:8px"></div>
                <span class="legend-text large text-dark">Sangat Baik</span>
            </div>
            <div class="d-inline-block" style="margin-right:10px;">
                <div class="legend-block d-inline-block bg-success" style="margin-right:8px"></div>
                <span class="legend-text large text-dark">Baik</span>
            </div>
            <div class="d-inline-block" style="margin-right:10px;">
                <div class="legend-block d-inline-block bg-warning" style="margin-right:8px"></div>
                <span class="legend-text large text-dark">Sedang</span>
            </div>
            <div class="d-inline-block" style="margin-right:10px;">
                <div class="legend-block d-inline-block bg-danger" style="margin-right:8px"></div>
                <span class="legend-text large text-dark">Buruk</span>
            </div>
        </div>
    </div>
</div>
