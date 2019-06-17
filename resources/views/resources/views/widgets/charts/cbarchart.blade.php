<canvas height="95px" id="barchart"></canvas >
<script>
		var barChartData = {
			labels: [
				@php
				foreach($bar as $k => $v){
					echo "'$k',";
				}
				@endphp
			],
			datasets: [

			@php
				$is_multi = false;
				if(isset($bar)){
					foreach($bar as $k => $v){
						if(is_array($v)){
							$is_multi = true; 
						}
					}

					if(!$is_multi){
						echo "{";
						echo "label: '$judul',";
						echo "backgroundColor: window.chartColors.red,";
						echo "data: [";
						foreach($bar as $k => $v){
							echo "$v,";
						}
						echo "]";
						echo "}";
					}else{
						$data = [];
						foreach($bar as $k => $v){
							foreach($v as $a => $b){
								$data[$a][$k] = $b;
							}
						}
						$i=0;
						foreach($data as $k => $v){
							echo "{";
							echo "\tlabel: '$k',\n";
							echo "\tbackgroundColor: window.chartColors2[$i],\n";
							echo "\tdata: [\n";
							foreach($v as $a => $b){
								echo "\t\t$b,\n";
							}
							echo "\t],\n";
							echo "},";
							$i++;
						}
					}
				}
			@endphp
			]
		};

		$(document).ready(function(){
			var ctx = document.getElementById('barchart').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					title: {
						display: false,
						text: 'Chart.js Bar Chart - Stacked'
					},
					tooltips: {
						mode: 'index',
						intersect: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: {{$is_multi?'true':'false'}},
							ticks: {autoSkip: false,maxRotation: 0,minRotation: 0}
						}],
						yAxes: [{
							stacked: {{$is_multi?'true':'false'}}
						}]
					},
					legend: {
			            display: true,
			            position: 'bottom'
			        }
				}
			});

			
		});
	</script>