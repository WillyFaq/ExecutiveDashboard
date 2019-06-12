@php
	$_idpie = rand(0, 999); 
@endphp
<canvas height="155px" id="pie_{{$_idpie}}"></canvas >
<script>

		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						80,
						15
					],
					backgroundColor: [
						"#BE1E2D",
						"#FE8C00"
					],
					label: 'Dosen'
				}],
				labels: ["Dosen Tetap", "Dosen Tidak Tetap"],
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