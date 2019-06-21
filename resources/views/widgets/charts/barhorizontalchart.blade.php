@php
	$_idbx = rand(0, 999); 
@endphp
<style>
	#chart-legends_{{$_idbx}}{
  		position: absolute;
  		bottom: 30px;
  		right: -25px;
	}
	#chart-legends_{{$_idbx}} .regis-legend{
		padding: 0;
		margin: 0;
		list-style: none;
	}
	#chart-legends_{{$_idbx}} .regis-legend>li{
		padding: 0;
		margin: 0;
	}
	#chart-legends_{{$_idbx}} .regis-legend>li>div{
		width: 8px;
		height: 8px;
		float: left;
		margin-top: 6px;
		margin-right: 5px;
	}
</style>
<div class="col-xs-11" style="padding:0;">
	<canvas height="299px" id="hormixchart_{{$_idbx}}"></canvas >
	<div id="chart-legends_{{$_idbx}}"></div>
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
							echo "{y:'$k', x:$v},";
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
					responsive: true,
					legend: {
						display:false,
						position: 'right',
					},
					legendCallback: function(chart) {
			            var text = []; 
					    text.push('<ul class="regis-legend ' + chart.id + '-legend">'); 
					    for (var i = 0; i < chart.data.datasets.length; i++) { 
					        text.push('<li><div style="background-color:' + chart.data.datasets[i].backgroundColor + '"></div>'); 
					        if (chart.data.datasets[i].label) { 
					            text.push(chart.data.datasets[i].label); 
					        } 
					        text.push('</li>'); 
					    } 
					    text.push('</ul>'); 
					    //console.log(text);
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
								stepSize: 30,
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
			document.getElementById('chart-legends_{{$_idbx}}').innerHTML = hormixchart.generateLegend();

		});

	</script>
