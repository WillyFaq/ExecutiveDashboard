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
@php
	if($type=='sertifikasi'){
		$labels = ['Sertifikasi Profesi', 'Sertifikasi Kompetensi', 'Pendidik Profesional'];
		$data_chart = [
						'strata_1' 		=> [400, 420, 400], 
						'strata_2'		=> [350, 300, 350], 
						'strata_3' 		=> [250, 200, 150], 
						'jumlah_dosen' 	=> [450, 300, 250]
						];
	}else if($type=='jafung'){
		$labels = ['Tenaga Pengajar', 'Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar'];
		$data_chart = [
						'strata_1' 		=> [400, 420, 400, 320, 0], 
						'strata_2'		=> [350, 300, 350, 320, 0], 
						'strata_3' 		=> [250, 200, 150, 320, 0], 
						'jumlah_dosen' 	=> [450, 300, 250, 320, 0]
						];
	}

	function show_array($arr, $type){
		$ret = "";
		if($type==0){
			foreach($arr as $k => $v){
				$ret .= "'$v',";
			}
		}else if($type==1){
			foreach($arr as $k => $v){
				$ret .= "$v,";
			}
		}
		return $ret;
	}
@endphp
<script>

		var mixChartData = {
			labels: [{!! show_array($labels, 0) !!}],
			datasets: [

				{
					label: 'Jumlah Dosen',
					borderColor: '#C91865',
					backgroundColor: '#C91865',
					borderWidth: 4,
					fill:false,
					data: [{{ show_array($data_chart['jumlah_dosen'], 1) }}],
					type: 'line',lineTension: 0
				},
				{
					label: 'Strata 1',
					borderColor: '#95A5A6',
					backgroundColor: '#95A5A6',
					data: [{{ show_array($data_chart['strata_1'], 1) }}]
				},

				{
					label: 'Strata 2',
					borderColor: '#1ABC9C',
					backgroundColor: '#1ABC9C',
					data: [{{ show_array($data_chart['strata_2'], 1) }}]
				},

				{
					label: 'Strata 3',
					borderColor: '#34495E',
					backgroundColor: '#34495E',
					data: [{{ show_array($data_chart['strata_3'], 1) }}]
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