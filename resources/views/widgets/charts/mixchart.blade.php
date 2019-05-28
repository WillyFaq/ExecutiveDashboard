@php
	$_idbx = rand(0, 999); 
@endphp
<canvas height="245px" id="mixchart_{{$_idbx}}"></canvas >

<script>
		var mixChartData = {
			labels: [
				@php
				foreach($data['sekarang'][1] as $k => $v){
					echo "'$k',";
				}
				@endphp
			],
			datasets: [
			@php
				if(isset($data)){
					echo "{";
						echo "label: '".$data['sekarang'][0]."',";
						echo "borderColor: '#BE1E2D',";
						echo "backgroundColor: '#BE1E2D',";
						echo "borderWidth: 1,";
						echo "fill: false,";
						echo "data: [";
						foreach($data['sekarang'][1] as $k => $v){
							echo "$v,";
						}
						echo "],";
						echo "yAxisID: 'y-axis-1',";
					echo "},\n";
					echo "{";
						echo "label: '".$data['lalu'][0]."',";
						echo "borderColor: 'rgba(35, 134, 222, 0.3)',";
						echo "backgroundColor: 'rgba(35, 134, 222, 0.3)',";
						echo "borderWidth: 3,";
						echo "fill: true,";
						echo "data: [";
						foreach($data['lalu'][1] as $k => $v){
							echo "$v,";
						}
						echo "],";
						echo "type: 'line'";
					echo "},";
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

							barPercentage: 0.5,
				            barThickness: 6,
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
								max: 400,
								stepSize: 50,
								suggestedMin: 0,
								suggestedMax: 400,
								fontSize: 10
							}
						}],
					},
					legend: {
			            display: true,
			            position: 'bottom'
			        }
				}
			});

		});
	</script>