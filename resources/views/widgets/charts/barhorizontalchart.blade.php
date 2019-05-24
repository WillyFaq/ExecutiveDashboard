@php
	$_idbx = rand(0, 999); 
@endphp
<canvas height="230px" id="hormixchart"></canvas >

<script>
		var hormixChartData = {
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
						echo "borderColor: '#FF6B6B',";
						echo "backgroundColor: '#FF6B6B',";
						echo "borderWidth: 1,";
						echo "data: [";
						foreach($data['sekarang'][1] as $k => $v){
							echo "$v,";
						}
						echo "],";
					echo "},\n";
					echo "{";
						echo "label: '".$data['lalu'][0]."',";
						echo "borderColor: '#91EAE4',";
						echo "backgroundColor: '#91EAE4',";
						echo "borderWidth: 3,";
						echo "fill: false,";
						echo "data: [";
						foreach($data['lalu'][1] as $k => $v){
							echo "{x:$v, y:'$k'},";
						}
						echo "],";
						echo "type: 'line'";
					echo "},";
				}
			@endphp
				
			]
		};

		$(document).ready(function(){
			var ctx = document.getElementById('hormixchart').getContext('2d');
			
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
						position: 'right',
					},
					title: {
						display: false,
						text: 'Chart.js Horizontal Bar Chart'
					}
				}
			});

		});

	</script>