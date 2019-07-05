@php
	$_idbx = rand(0, 999); 
@endphp
<div class="m-auto" style="height:388px;">
	<canvas id="mixchart_{{$_idbx}}"></canvas >
</div>

<script>
		var mixChartData_{{$_idbx}} = {
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
						echo "borderColor: '#2C3E50',";
						echo "backgroundColor: '#2C3E50',";
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
						echo "borderColor: '#1ABC9C',";
						echo "backgroundColor: '#1ABC9C',";
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
			var ctxa_{{$_idbx}} = document.getElementById('mixchart_{{$_idbx}}').getContext('2d');
			var mixchart_{{$_idbx}} = new Chart(ctxa_{{$_idbx}}, {
    			type: 'bar',
				data: mixChartData_{{$_idbx}},
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
								// stepSize: 1,
								// suggestedMin: 0,
								// suggestedMax: 400,
								fontSize: 10
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
							text.push('<div class="chart-subtitle d-block">');
							text.push('<div class="mx-1 legend-block d-inline-block" style="background-color: :warna"></div>'
							.replace(':warna',chart.data.datasets[i].backgroundColor)); 
							text.push(chart.data.datasets[i].label);
							text.push(': ');
							text.push('<span class="font-weight-bold">:jml_orang Orang</span>'
							.replace(':jml_orang', chart.data.datasets[i].data.reduce(function(a,b){ 
								return a+b; 
							})));
							text.push('</div>');
					    } 

					    return text.join(''); 
			        },
                    onClick: function(mouseEvent, clickedChart) {
						return {{$onClickFn}}(mouseEvent, clickedChart, mixchart_{{$_idbx}});
					},
				}
			});
			document.getElementById('{{$id_legend}}').innerHTML = mixchart_{{$_idbx}}.generateLegend();

		});
	</script>
