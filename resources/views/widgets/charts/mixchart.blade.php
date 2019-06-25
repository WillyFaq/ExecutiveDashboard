@php
	$_idbx = rand(0, 999); 
@endphp
<div class="m-auto" style="position:relative; width:272px; height:207px;">
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
						text.push('<div class="row">');
					    for (var i = 0; i < chart.data.datasets.length; i++) { 
							text.push('<div class="col">');
					        if (chart.data.datasets[i].label) { 
								if(i%2==0){
									text.push('<div class="txt_card_subtitle text-right">');
								}else{
									text.push('<div class="txt_card_subtitle text-left">');
								}
								text.push('<span>');
								text.push('<div style="background-color:' + chart.data.datasets[i].backgroundColor + '; height:8px; width:8px; display:inline-block; margin-right:5px;"></div>'); 
					            text.push(chart.data.datasets[i].label); 
								text.push('</span>');
								text.push('</div>');
					        } 
							text.push('</div>');
					    } 
						text.push('</div>');

					    return text.join(''); 
			        },
				}
			});
			document.getElementById('{{$id_legend}}').innerHTML = mixchart.generateLegend();

		});
	</script>
