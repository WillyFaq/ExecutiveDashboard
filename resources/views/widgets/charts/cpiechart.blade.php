@php
	$_idpie = rand(0, 999); 
@endphp
<canvas class="canvas_cpiechart"  id="pie_{{$_idpie}}"></canvas >
<script>

		let config = {
			type: 'pie',
			data: {
				datasets: [{
					data: {!! json_encode(array_values($data)) !!},
					backgroundColor: [
						"#1ABC9C",
						"#2C3E50"
					],
					label: 'Dosen'
				}],
				labels: {!! json_encode(array_keys($data)) !!},
			},
			options: {
				responsive: false,
    			maintainAspectRatio: false,
				legend: {
		            display: false,
		        },
				legendCallback: function(chart) {
					var text = []; 
					text.push('<div class="row">');
					for (var i = 0; i < chart.data.datasets[0].data.length; i++) { 
						text.push('<div class="col">');
						if (chart.data.labels[i]) { 
							text.push('<div class="chart-subtitle">');
							text.push('<span>');
							text.push('<div style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '; height:8px; width:8px; display:inline-block; margin-right:5px;"></div>'); 
							text.push(chart.data.labels[i]);
							text.push(': ');
							text.push('<strong>'+chart.data.datasets[0].data[i]+' Orang</strong>');
							text.push('</span>');
							text.push('</div>');
						} 
						text.push('</div>');
					} 
					text.push('</div>');

					return text.join(''); 
				},
			}
		};

		$(document).ready(function(){
			var ctxa = document.getElementById('pie_{{$_idpie}}').getContext('2d');
			window.myPie = new Chart(ctxa, config);
			document.getElementById('{{$id_legend}}').innerHTML = window.myPie.generateLegend();
		});
	</script>
