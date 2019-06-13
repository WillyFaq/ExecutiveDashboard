@php
	$_idbx = rand(0, 999); 
@endphp
<canvas height="105px" id="mixchart_{{$_idbx}}"></canvas >

<script>
		$(document).ready(function(){
			var ctxa = document.getElementById('mixchart_{{$_idbx}}').getContext('2d');
			
			var mixchart = new Chart(ctxa, {
    			type: 'bar',
				data: {!! json_encode([
                    'labels' => array_keys($data['line'][1]),
                    'datasets' => [
                        [
                            'label' => $data['line'][0],
                            'borderColor' => '#BE1E2D',
                            'backgroundColor' => '#BE1E2D',
                            'borderWidth' => 4,
                            'fill' => false,
                            'data' => array_values($data['line'][1]),
                            'type' => 'line',
                            'lineTension' => 0
                        ],
                        [
                            'label' => $data['bar'][0],
                            'borderColor' => '#FE9D28',
                            'backgroundColor' => '#FE9D28',
                            'borderWidth' => 1,
                            'fill' => false,
                            'data' => array_values($data['bar'][1]),
                            'yAxisID' => 'y-axis-1',
                        ]
                    ],
                ]) !!},
				options: {
					responsive: true,
					hoverMode: 'index',
					stacked: false,
					title: {
						display: false,
						text: 'Chart.js Line Chart - Multi Axis'
					},
					scales: {
						xAxes: [{
							gridLines:  {
								display: false
							},
							ticks: {
								fontSize: 10
							},

							barPercentage: 1,
				            barThickness: 30,
						}],
						yAxes: [{
							gridLines:  {
								display: true,
							},
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							id: 'y-axis-1',
					        ticks: {
								// min: 150,
								// max: 500,
								stepSize: 1,
								// suggestedMin: 0,
								// suggestedMax: 400,
								fontSize: 10
							}
						}],
					},
					legend: {
			            display: false,
			            position: 'bottom'
			        }
				}
			});

		});
	</script>
