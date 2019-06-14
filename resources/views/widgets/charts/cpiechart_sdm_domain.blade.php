@php
    $_idpie = rand(0, 999); 
@endphp
<canvas id="pie_{{$_idpie}}"></canvas >
<script>
    let config = {
        type: 'pie',
        data: {
            datasets: [{
                data: {!! json_encode(array_map(function($domain){
                    return $domain['persen'];
                },$data)) !!},
                backgroundColor: {!! json_encode(array_values($color)) !!},
            }],
            labels: {!! json_encode(array_map(function($domain){
                return $domain['domain'];
            },$data)) !!},
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
