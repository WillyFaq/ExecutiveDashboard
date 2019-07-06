@php
	$_idbx = rand(0, 999); 
@endphp
<div class="m-auto" style="position:relative; height:356px;">
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
						echo "pointRadius: 8,";
						echo "pointHoverRadius: 10,";
						echo "fill: false,";
						echo "data: [";
						foreach($data['line'][1] as $k => $v){
							echo "$v,";
						}
						echo "],";
						echo 'datalabels: '.json_encode($data_labels['line']);
						echo ",";
						echo "type: 'line',";
						echo "lineTension: 0,";
						echo "yAxisID: 'dosen_tetap',";
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
						echo 'datalabels: '.json_encode($data_labels['bar']);
						echo ",";
						echo "yAxisID: 'dosen_tetap',";
					echo "},\n";
					echo "{";
						echo "label: '".$data['line_target'][0]."',";
						echo "borderColor: 'rgba(241, 196, 15, 0.35)',";
						echo "backgroundColor: 'rgba(241, 196, 15, 0.35)',";
						echo "borderWidth: 0,";
						echo "pointRadius: 0,";
						echo "pointHoverRadius: 0,";
						echo "fill: true,";
						echo "data: [";
						foreach($data['line_target'][1] as $k => $v){
							echo "$v,";
						}
						echo "],";
						echo 'datalabels: '.json_encode($data_labels['line_target']);
						echo ",";
						echo "type: 'line',";
						echo "yAxisID: 'dosen_tetap',";
					echo "},\n";
					
				}
			@endphp
				
			]
		};

		$(document).ready(function(){
			var ctxa_{{$_idbx}} = document.getElementById('mixchart_{{$_idbx}}').getContext('2d');
			var mixchart_{{$_idbx}} = new Chart(ctxa_{{$_idbx}}, {
				plugins: [ChartDataLabels],
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
							id: 'dosen_tetap',
							gridLines:  {
								display: true,
							},
							type: 'linear',
							display: true,
							position: 'right',
					        ticks: {
								min: 0,
								max: Math.ceil({{max($data['bar'][1])}}/5)*5,
								stepSize: 5,
								fontSize: 10,
							},
						},{
							id: 'persentase',
							gridLines:  {
								display: false,
							},
							type: 'linear',
							display: true,
							position: 'left',
					        ticks: {
								min: 0,
								max: Math.ceil({{max($data['bar'][1])}}/5)*5,
								stepSize: 5,
								fontSize: 10,
								callback: function(tick){
									let percent = tick/{{array_sum($data['bar'][1])}};
									return (Math.round(percent*100))+'%';
								}
							},
						}],
					},
					legend: {
			            display: false,
			        },
					legendCallback: function(chart) {
			            var text = []; 
					    for (var i = 0; i < chart.data.datasets.filter(function(data){
							return data.label != 'Target';
						}).length; i++) { 
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
