@php
	$_idbx = rand(0, 999); 
@endphp
<div class="m-auto" style="position:relative; height:295px">
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
						echo "borderColor: '#1ABC9C',";
						echo "backgroundColor: '#1ABC9C',";
						echo "borderWidth: 1,";
						echo "data: [";
						foreach($data['sekarang'][1] as $k => $v){
							echo "$v,";
						}
						echo "],";
						echo 'datalabels: '.json_encode([
							'display' => true,
							'anchor' => 'end',
							'align' => 'end',
						]);
					echo "},\n";
					echo "{";
						echo "label: '".$data['lalu'][0]."',";
						echo "borderColor: '#2C3E50',";
						echo "backgroundColor: '#2C3E50',";
						echo "borderWidth: 3,";
						echo "data: [";
						foreach($data['lalu'][1] as $k => $v){
							echo "$v,";
						}
						echo "],";
						echo "fill: 'end',";
						echo 'datalabels: '.json_encode([
							'display' => false,
						]);
					echo "},";
				}
			@endphp
				
			]
		};

		$(document).ready(function(){
			var ctx = document.getElementById('hormixchart_{{$_idbx}}').getContext('2d');
			
			var hormixchart = new Chart(ctx, {
				plugins: [ChartDataLabels],
    			type: 'horizontalBar',
				data: hormixChartData,
				options: {
					plugins: {
						datalabels: {
							// hide datalabels for all datasets
							display: false
						}
					},
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
					scales: {
						yAxes: [{
							barPercentage: 0.6,
							categoryPercentage: 0.8,
				            ticks:{
				            	beginAtZero: true,
	                            reverse: true,
	                            start: 0,
								mirror: true,
								padding: 80,
				            },
							gridLines:  {
								display: false,
							},
							afterFit: function(scaleInstance) {
								scaleInstance.width = 90;
							}
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
