@php
    $_idbx = rand(0, 999); 
@endphp
<canvas height="180px" id="linechart_{{$_idbx}}"></canvas >
<script>
    $(document).ready(function(){
        var ctx = document.getElementById('linechart_{{$_idbx}}').getContext('2d');
        var myLine = Chart.Line(ctx, {
            plugins: [ChartDataLabels],
            data: {
                labels: {!! json_encode(array_map(function($key){
                    return substr($key,-2);
                }, array_keys($data))) !!},
                datasets: [
                    {
                        label: 'Jumlah',
                        borderColor: '#1ABC9C',
                        backgroundColor: '#1ABC9C',
                        borderWidth: 1.5,
                        fill: true,
                        yAxisID: 'y-axis-1',
                        pointRadius: 2,
                        pointHoverRadius: 2,
                        data: {!! json_encode(array_values($data)) !!},
                        datalabels: {
                            show: true,
                            anchor: 'end',
                            align: 'end',
                        }
                    }
                ]
            },
            options: {
                responsive: true,
                hoverMode: 'index',
                stacked: false,
                title: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        gridLines:  {
                            display: true
                        },
                        ticks: {
                            fontSize: 10
                        }
                    }],
                    yAxes: [{
                        gridLines:  {
                            display: true,
                        },
                        type: 'linear',
                        display: false,
                        id: 'y-axis-1',
                        ticks: {
                            fontSize: 10
                        }
                    }],
                },
                legend: {
                    display: false,
                }
            }
        });

    });
</script>
