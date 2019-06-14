<canvas height="115px" id="linechart"></canvas >
<script>
		var lineChartData = {
			labels: [
				<?php
				//foreach($line as $k => $v){
					//echo "'$k',";
					echo '';
				//}
				?>
			],
			datasets: [
			@php
				if(isset($line)){
					echo "{";
						echo "label: 'Peringkat',";
						echo "borderColor: '#BE1E2D',";
						echo "backgroundColor: '#BE1E2D',";
						echo "borderWidth: 1.5,";
						echo "fill: false,";
						echo "data: [";
						foreach($line as $k => $v){
							echo "$v,";
						}
						echo "],";
						echo "yAxisID: 'y-axis-1',";
						echo "pointRadius: 5,";
						echo "pointHoverRadius: 6,";
						echo "},";
				}
			@endphp
				{
					label: 'Dashed',
					fill: false,
					borderColor: '#FE8C00',
					borderWidth: 1,
					borderDash: [5, 5, 5],
					data: [
						@php
						foreach($line as $k => $v){
							echo "200,";
						}
						@endphp
					],
					pointRadius: 0,
					pointHoverRadius: 0,
				},
				{
					label: 'Dashed',
					fill: false,
					borderColor: '#FE8C00',
					borderWidth: 1,
					borderDash: [5, 5, 5],
					data: [
						@php
						foreach($line as $k => $v){
							echo "300,";
						}
						@endphp
					],
					pointRadius: 0,
					pointHoverRadius: 0,
				},
				{
					label: 'Dashed',
					fill: false,
					borderColor: '#FE8C00',
					borderWidth: 1,
					borderDash: [5, 5, 5],
					data: [
						@php
						foreach($line as $k => $v){
							echo "360,";
						}
						@endphp
					],
					pointRadius: 0,
					pointHoverRadius: 0,
				},
			]
		};

		$(document).ready(function(){
			var ctx = document.getElementById('linechart').getContext('2d');
			
			var myLine = Chart.Line(ctx, {
				data: lineChartData,
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
							}
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
			            display: false,
			            position: 'right'
			        }
				}
			});

		});
	</script>