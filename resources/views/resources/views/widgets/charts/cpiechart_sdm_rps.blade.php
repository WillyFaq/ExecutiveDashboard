@php
    $_idpie = rand(0, 999); 
@endphp
<canvas id="pie_{{$_idpie}}"></canvas >
<script>
    let config = {
        type: 'pie',
        data: {
            datasets: [{
                data: {!! json_encode(array_values(array_map(function($sks) use ($data) {
                    return round($sks/array_sum($data)*100,2);
                },$data))) !!},
                backgroundColor: {!! json_encode(array_values($color)) !!},
            }],
            labels: {!! json_encode($label) !!},
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: {
                display: false,
            }
        }
    };

    $(document).ready(function(){
        var ctxa = document.getElementById('pie_{{$_idpie}}').getContext('2d');
        window.myPie = new Chart(ctxa, config);
    });
</script>
