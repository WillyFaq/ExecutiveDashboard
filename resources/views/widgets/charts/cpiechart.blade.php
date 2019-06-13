@php
	$_idpie = rand(0, 999); 
@endphp
<canvas height="155px" id="pie_{{$_idpie}}"></canvas >
<script>

		let config = {
			type: 'pie',
			data: {
				datasets: [{
					data: {!! json_encode(array_values($data)) !!},
					backgroundColor: [
						"#BE1E2D",
						"#FE8C00"
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
