<canvas  id="linechart"></canvas >

<script>
		var lineChartData = {
			labels: [
				@php
				foreach($line as $k => $v){
					echo "'$k',";
				}
				@endphp
			],
			datasets: [
			@php
				if(isset($line)){
					$is_multi = false;
					foreach($line as $k => $v){
						if(is_array($v)){
							$is_multi = true; 
						}
					}

					if(!$is_multi){
						echo "{";
						echo "label: '$judul',";
						echo "borderColor: window.chartColors.red,";
						echo "backgroundColor: window.chartColors.red,";
						echo "fill: false,";
						echo "data: [";
						foreach($line as $k => $v){
							echo "$v,";
						}
						echo "],";
						echo "yAxisID: 'y-axis-1',";
						echo "}";
					}else{
						$data = [];
						foreach($line as $k => $v){
							foreach($v as $a => $b){
								$data[$a][$k] = $b;
							}
						}
						$i=0;
						foreach($data as $k => $v){
							echo "{";
							echo "\tlabel: '$k',\n";
							echo "\tborderColor: window.chartColors2[$i],\n";
							echo "\tbackgroundColor: window.chartColors2[$i],\n";
							echo "\tfill: false,\n";
							echo "\tdata: [\n";
							foreach($v as $a => $b){
								echo "\t\t$b,\n";
							}
							echo "\t],\n";
							echo "\tyAxisID: 'y-axis-1',\n";
							echo "},";
							$i++;
						}
					}
				}
			@endphp
			]
		};

		$(document).ready(function(){
			var ctx = document.getElementById('linechart').getContext('2d');
			window.myLine = Chart.Line(ctx, {
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
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'left',
							id: 'y-axis-1',
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