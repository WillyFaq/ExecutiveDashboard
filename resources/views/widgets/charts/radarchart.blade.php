<div class="m-auto" style="position:relative; height:415px;">
	<canvas id="radarchart"></canvas>
</div>

<script>
    @php
        $label = array_map(function($data_profil) {
            return [
                $data_profil['nama'],
                $data_profil['nilai'],
            ];
        }, $data_profil);
        $data = array_map(function($data_profil) {
            return $data_profil['nilai'];
        }, $data_profil);
    @endphp
    var label = {!! json_encode(array_values($label)) !!};
    var data = {!! json_encode(array_values($data)) !!};
		var color = Chart.helpers.color;
		var config = {
			type: 'radar',
			data: {
				labels: label,
				datasets: [{
					label: 'Kriteria Perguruan Tinggi',
					backgroundColor: 'rgba(26, 188, 156, 0.5)',//color(window.chartColors.red).alpha(0.2).rgbString(),
					borderColor: '#1ABC9C',//window.chartColors.red,
					pointBackgroundColor: '#1ABC9C',//window.chartColors.red,
					data: data
				}]
			},
			options: {
				legend: {
					display: false,
					position: 'top',
				},
				title: {
					display: false,
					text: 'Chart.js Radar Chart'
				},

				scale: {
					 pointLabels: {
					 	fontSize:11,
                        callback: function(value, index, values) {
                        	//console.log(value);
                            return value;
                        }
                    },
					ticks: {
						min: 0,
						max: 4,
						display:false
					}
				}
			}
		};
        window.onload = function() {
            let chartElement = document.getElementById('radarchart');
            let chartContext = chartElement.getContext('2d');
            window.myRadar = new Chart(chartContext, config);
            chartElement.onclick = function(e){
                let dot = window.myRadar.getElementAtEvent(e);
                if(!dot.length) return;
                window.location.href = label[dot[0]._index][0].replace(' ','_').toLowerCase();
            }
        };
		

		/*
		$(document).ready(function(){
			var ctx = document.getElementById('radarchart').getContext('2d');
			
			var myLine = Chart.Line(ctx, {
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
						xAxes: [{
							gridLines:  {
								display: false
							},
							ticks: {
								fontSize: 10
							}
						}],
						yAxes: [{
							gridLines:  {
								display: true,
							},
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							id: 'y-axis-1',
					        ticks: {
								min: 150,
								max: 400,
								stepSize: 50,
								suggestedMin: 0,
								suggestedMax: 400,
								fontSize: 10
							}
						}],
					},
					legend: {
			            display: false,
			            position: 'right'
			        }
				}
			});

		});*/
	</script>
