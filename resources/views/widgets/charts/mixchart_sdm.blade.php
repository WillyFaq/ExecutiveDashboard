@php
	$_idbx = rand(0, 999); 
@endphp
<canvas height="105px" id="mixchart_{{$_idbx}}"></canvas >

<script>
		var mixChartData = {
			labels: [
				@php
				foreach($data['bar'][1] as $k => $v){
					echo "'$k',";
				}
				@endphp
			],
			datasets: [
			@php
				if(isset($data)){
					echo "{";
						echo "label: '".$data['line'][0]."',";
						echo "borderColor: '#BE1E2D',";
						echo "backgroundColor: '#BE1E2D',";
						echo "borderWidth: 4,";
						echo "fill: false,";
						echo "data: [";
						foreach($data['line'][1] as $k => $v){
							echo "$v,";
						}
						echo "],";
						echo "type: 'line',";
						echo "lineTension: 0";
					echo "},\n";
					echo "{";
						echo "label: '".$data['bar'][0]."',";
						echo "borderColor: '#FE9D28',";
						echo "backgroundColor: '#FE9D28',";
						echo "borderWidth: 1,";
						echo "fill: false,";
						echo "data: [";
						foreach($data['bar'][1] as $k => $v){
							echo "$v,";
						}
						echo "],";
						echo "yAxisID: 'y-axis-1',";
					echo "},\n";
					
				}
			@endphp
				
			]
		};

		$(document).ready(function(){
			var ctxa = document.getElementById('mixchart_{{$_idbx}}').getContext('2d');
			
			var mixchart = new Chart(ctxa, {
    			type: 'bar',
				data: mixChartData,
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
								min: 150,
								max: 500,
								stepSize: 50,
								suggestedMin: 0,
								suggestedMax: 400,
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