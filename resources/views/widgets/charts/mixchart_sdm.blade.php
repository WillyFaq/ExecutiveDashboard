@php
	$_idbx = rand(0, 999); 
@endphp
<canvas height="105px" id="mixchart_{{$_idbx}}"></canvas >

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
						echo "borderColor: '#BE1E2D',";
						echo "backgroundColor: '#BE1E2D',";
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
						echo "borderColor: '#FE9D28',";
						echo "backgroundColor: '#FE9D28',";
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
			        onClick: function(c,i) {
    					console.log(c.y);
    					e = i[0];
					    //console.log(e._index)
					    var x_value = this.data.labels[e._index];
					    var y_value = this.data.datasets[0].data[e._index];
					    //console.log(x_value);
					    /*
					    console.log(y_value);
					    var label = "";*/
					    if(c.y>316){
					    	document.location="{{url('sdm/dosen')}}";
					    }else{
					    	show_modal(x_value);
					    }
						//$("#modal_chart").modal('show');
					}
				}
			});

		});
	</script>
