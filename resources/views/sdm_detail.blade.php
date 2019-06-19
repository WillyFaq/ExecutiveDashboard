<script type="text/javascript">
	//var _jquery = "{{ asset("js/jquery.js") }}";
	var _chart = "{{ asset("js/chart.js") }}";
	var _utils = "{{ asset("js/Utils.js") }}";
	//$.getScript(_jquery);
	$.getScript(_chart);
	$.getScript(_utils);
</script>
@php
	$_idd = rand(0, 999); 
@endphp
<canvas height="105px" id="mixchart_ajax"></canvas >
<script>
		var mixChartData = {
			labels: ['Strata 1', 'Strata 2', 'Strata 3'],
			datasets: [

				{
					label: 'Jumlah Dosen',
					borderColor: '#C216CC',
					backgroundColor: '#C216CC',
					borderWidth: 4,
					fill:false,
					data: [450,300,250],
					type: 'line',lineTension: 0
				},

				{
					label: 'Sertifikasi',
					borderColor: '#BE1E2D',
					backgroundColor: '#BE1E2D',
					data: [400,400,400]
				},

				{
					label: 'Guru Besar',
					borderColor: '#FE9D28',
					backgroundColor: '#FE9D28',
					data: [300,300,300]
				},

				{
					label: 'Lektor Kepala',
					borderColor: '#4FACFE',
					backgroundColor: '#4FACFE',
					data: [150,150,150]
				},

			]
		};

		$(document).ready(function(){
			var ctxa = document.getElementById('mixchart_ajax').getContext('2d');
			
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

						}],
						yAxes: [{
							gridLines:  {
								display: true,
							},
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							id: 'y-axis-1',
					        ticks: {
								min: 0,
								max: 500,
								stepSize: 50,
								suggestedMin: 0,
								suggestedMax: 400,
								fontSize: 10
							}
						}],
					},
					legend: {
			            display: false,
			            position: 'bottom'
			        }
				}
			});

		});
	</script>