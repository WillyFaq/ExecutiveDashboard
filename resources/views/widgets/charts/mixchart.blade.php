@php
	$_idbx = rand(0, 999); 
@endphp
<style>
	#chart-legends_{{$_idbx}} .regis-legend{
		padding: 0;
		margin: 0;
		list-style: none;
		text-align: center;
	}
	#chart-legends_{{$_idbx}} .regis-legend>.legend-item{
		/* padding: 0;
		margin: 0; */
		padding-right:10px;
		float: left;
	}
	#chart-legends_{{$_idbx}} .regis-legend>.legend-item>.color{
		width: 40px;
		height: 8px;
		float: left;
		margin-top: 6px;
		margin-right: 5px;
	}
</style>
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
						text.push('<div class="col-xs-1"></div>');
					    for (var i = 0; i < chart.data.datasets.length; i++) { 
							text.push('<div class="col-xs-3">');
							text.push('<div class="line-txt" style="border: 1px solid ' + chart.data.datasets[i].backgroundColor + '; margin-top:8px;"></div>'); 
							text.push('</div>');
							text.push('<div class="col-xs-2">');
					        if (chart.data.datasets[i].label) { 
								text.push('<p class="txt_card_subtitle text-left">');
					            text.push(chart.data.datasets[i].label); 
								text.push('</p>');
					        } 
							text.push('</div>');
					    } 
						text.push('</div>');
					    // text.push('<table class="tbl-legend-home ' + chart.id + '-legend">'); 
						// text.push('<tr>');
					    // for (var i = 0; i < chart.data.datasets.length; i++) { 
					    //     text.push('<td>');
						// 	text.push('<div class="line-txt" style="border: 1px solid ' + chart.data.datasets[i].backgroundColor + '"></div>'); 
					    //     text.push('</td>'); 
					    //     text.push('<td>');
					    //     if (chart.data.datasets[i].label) { 
					    //         text.push(chart.data.datasets[i].label); 
					    //     } 
					    //     text.push('</td>'); 
					    // } 
						// text.push('</tr>');
					    // text.push('</table>'); 
					    // //console.log(text);
					    return text.join(''); 
			        },
				}
			});
			document.getElementById('{{$id_legend}}').innerHTML = mixchart.generateLegend();

		});
	</script>
