@php
	$_idbx = rand(0, 999); 
@endphp
<div class="m-auto" style="position:relative; height:295px">
	<canvas id="mixchart_{{$_idbx}}"></canvas >
</div>

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
						echo "borderColor: '#1ABC9C',";
						echo "backgroundColor: '#1ABC9C',";
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
						// echo "borderColor: 'rgba(241, 196, 15, 0.3)',";
						echo "backgroundColor: 'rgba(241, 196, 15, 0.3)',";
						echo "borderWidth: 0,";
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
  					maintainAspectRatio: false,
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
							barPercentage: 0.3,
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
								// max: 400,
								stepSize: 80,
								// suggestedMin: 0,
								// suggestedMax: 400,
								// fontSize: 10
							}
						}],
					},
					legend: {
			            display: false,
			            position: 'bottom'
			        },
					legendCallback: function(chart) {
			            var text = []; 
					    for (var i = 0; i < chart.data.datasets.length; i++) { 
							text.push('<div class="mr-1 d-inline-block">');
							text.push('<div class="mx-1 legend-block d-inline-block" style="background-color: :warna"></div>'
							.replace(':warna',chart.data.datasets[i].backgroundColor)); 
							text.push('<span class="legend-text small">');
							text.push(chart.data.datasets[i].label); 
							text.push('</span>');
							text.push('</div>');
					    } 

					    return text.join(''); 
			        },
				}
			});
			document.getElementById('{{$id_legend}}').innerHTML = mixchart.generateLegend();

		});
	</script>
