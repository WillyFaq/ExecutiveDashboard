<canvas style="width:100%; height:280px"  id="radarchart"></canvas >

<script>
	var label = [
					['Visi Misi', 3.50], 
					['Tata Pamong', 3.20], 
					['Mahasiswa', 3.15], 
					['SDM', 2.05],
					['Keuangan', 2.05], 
					['Pendidikan', 2.87], 
					['Penelitian', 2.56], 
					['Pengabdian', 2.75], 
					['Luaran', 2.45]
				];
	var datas = [];
	for(var i = 0; i < label.length; i++){
		datas.push(label[i][1]);
	}
		var randomScalingFactor = function() {
			return Math.round(Math.random() * 4);
		};
		var color = Chart.helpers.color;
		var config = {
			type: 'radar',
			data: {
				labels: label,
				datasets: [{
					label: 'Kriteria Perguruan Tinggi',
					backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
					borderColor: window.chartColors.red,
					pointBackgroundColor: window.chartColors.red,
					data: datas
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
			window.myRadar = new Chart(document.getElementById('radarchart'), config);
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