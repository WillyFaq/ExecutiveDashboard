@php
	$_idpie = rand(0, 999); 
@endphp
<div class="m-auto" style="position:relative; height:275px">
	<canvas id="pie_{{$_idpie}}"></canvas >
</div>
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
    			maintainAspectRatio: false,
				legend: {
		            display: false,
		        },
				legendCallback: function(chart) {
					var text = []; 
					for (var i = 0; i < chart.data.datasets[0].data.length; i++) { 
						if (chart.data.labels[i]) { 
							text.push('<div class="chart-subtitle d-block">');
							text.push('<span>');
							text.push('<div style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '; height:8px; width:8px; display:inline-block; margin-right:5px;"></div>'); 
							text.push(chart.data.labels[i]);
							text.push(': ');
							text.push('<strong>'+chart.data.datasets[0].data[i]+' Orang</strong>');
							text.push('</span>');
							text.push('</div>');
						} 
					} 

					return text.join(''); 

					var text = []; 
					for (var i = 0; i < chart.data.datasets.length; i++) { 
						text.push('<div class="chart-subtitle d-block">');
						text.push('<div class="mx-1 legend-block d-inline-block" style="background-color: :warna"></div>'
						.replace(':warna',chart.data.datasets[i].backgroundColor)); 
						text.push(chart.data.datasets[i].label);
						text.push(': ');
						text.push('<span class="font-weight-bold">:jml_orang Orang</span>'
						.replace(':jml_orang', chart.data.datasets[i].data.reduce(function(a,b){ 
							return a+b; 
						})));
						text.push('</div>');
					} 

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
