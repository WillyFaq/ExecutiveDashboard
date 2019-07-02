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
		        }
			}
		};

		$(document).ready(function(){
			var ctxa = document.getElementById('pie_{{$_idpie}}').getContext('2d');
			window.myPie = new Chart(ctxa, config);
		});
	</script>
