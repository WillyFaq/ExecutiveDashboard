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
						echo "borderColor: '#2C3E50',";
						echo "backgroundColor: '#2C3E50',";
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
						echo "borderColor: '#1ABC9C',";
						echo "backgroundColor: '#1ABC9C',";
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
    					if(i.length != 0){
    					
	    					e = i[0];
						   
						    var x_value = this.data.labels[e._index];
						    var y_value = this.data.datasets[0].data[e._index];
						    
						  	if($(document).height()<=768){ /*--- resolusi standar  ---*/
							    if(c.y>170 && c.y<342){ /*--- tampil modal chat atas  ---*/
							    	show_modal_jafung(x_value);
							    }else if(c.y>342 && c.y<364){ /*--- redirect chat atas  ---*/
							    	document.location="{{url('sdm/dosen')}}";
							    }else if(c.y>617 && c.y<671){ /*--- tampil modal chat bawah  ---*/
							    	show_modal_sertifikasi(x_value);
							    }else if(c.y>671 && c.y<695){ /*--- redirect chat bawah  ---*/
							    	document.location="{{url('sdm/dosen')}}";
							    }
						  	}else if($(document).height()>=1080){ /*--- resolusi standar  ---*/
						  		if(c.y>170 && c.y<450){
							    	show_modal_jafung(x_value);
						  		}else if(c.y>450 && c.y<475){
							    	document.location="{{url('sdm/dosen')}}";
						  		}else if(c.y>620 && c.y<897){
							    	show_modal_sertifikasi(x_value);
						  		}else if(c.y>897 && c.y<922){
							    	document.location="{{url('sdm/dosen')}}";
		
						    	}
						  	}
					    
    					}
						//$("#modal_chart").modal('show');
					}
				}
			});

		});
	</script>
