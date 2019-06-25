@php
	$_idbx = rand(0, 999); 
@endphp
<div class="m-auto" style="position:relative; width:272px; height:216px;">
	<canvas id="hormixchart_{{$_idbx}}"></canvas >
</div>

<script>
		var hormixChartData = {
			labels: [
				@php
				foreach($data['sekarang'][1] as $k => $v){
					echo "'$k', ";
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
						echo "data: [";
						foreach($data['sekarang'][1] as $k => $v){
							echo "$v,";
						}
						echo "],";
					echo "},\n";
					echo "{";
						echo "label: '".$data['lalu'][0]."',";
						echo "borderColor: 'rgba(35, 134, 222, 0.3)',";
						echo "backgroundColor: 'rgba(35, 134, 222, 0.3)',";
						echo "borderWidth: 3,";
						echo "data: [";
						foreach($data['lalu'][1] as $k => $v){
							echo "$v,";
						}
						echo "],";
						echo "fill: 'end',";
					echo "},";
				}
			@endphp
				
			]
		};

		$(document).ready(function(){
			var ctx = document.getElementById('hormixchart_{{$_idbx}}').getContext('2d');
			
			var hormixchart = new Chart(ctx, {
    			type: 'horizontalBar',
				data: hormixChartData,
				options: {
					// Elements options apply to all of the options unless overridden in a dataset
					// In this case, we are setting the border of each horizontal bar to be 2px wide
					elements: {
						rectangle: {
							borderWidth: 2,
						}
					},
  					maintainAspectRatio: false,
					legend: {
						display:false,
						position: 'right',
					},
					legendCallback: function(chart) {
			            var text = []; 
						text.push('<div class="row">');
					    for (var i = 0; i < chart.data.datasets.length; i++) { 
							text.push('<div class="col">');
					        if (chart.data.datasets[i].label) { 
								if(i%2==0){
									text.push('<div class="chart-subtitle text-right">');
								}else{
									text.push('<div class="chart-subtitle text-left">');
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
					scales: {
						yAxes: [{
							barPercentage: 0.5,
				            barThickness: 6,
				            ticks:{
				            	beginAtZero: true,
	                            reverse: true,
	                            start: 0
				            },
							gridLines:  {
								display: false,
							},
						}],
						xAxes: [{
							ticks: {
								// min: 150,
								// max: 500,
								stepSize: 80,
							},
							gridLines:  {
								display: true,
							},
						}]
						
					},
					title: {
						display: false,
						text: 'Chart.js Horizontal Bar Chart'
					}
				}
			});
			document.getElementById('{{$id_legend}}').innerHTML = hormixchart.generateLegend();

		});

	</script>
