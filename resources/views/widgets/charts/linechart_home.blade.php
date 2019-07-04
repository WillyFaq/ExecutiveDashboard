@php
	$_idbx = rand(0, 999); 
@endphp
<div class="m-auto" style="position:relative; height:389px;">
	<canvas id="linechart_{{$_idbx}}"></canvas >
</div>
<script>
		function renderLineChart_{{$_idbx}}(data){
			
			var ctx = document.getElementById('linechart_{{$_idbx}}').getContext('2d');
			
			var myLine = Chart.Line(ctx, {
				data: data,
				options: {
  					maintainAspectRatio: false,
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
								// min: 150,
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
					},
					legendCallback: function(chart){
						var text = []; 
						text.push('<div class="row">');
					    for (var i = 0; i < 2; i++) { 
							text.push('<div class="chart-subtitle">');
							text.push('<div class="mx-1" style="border:1px :dashed :color; height:0; margin-bottom:3px; width:25px; display:inline-block;"></div>'
							.replace(':dashed', chart.data.datasets[i].borderDash?'dashed':'solid')
							.replace(':color', chart.data.datasets[i].borderColor)); 
							text.push(chart.data.datasets[i].label); 
							text.push('</div>');
					    } 
						text.push('</div>');

					    return text.join(''); 
					}
				}
			});
			document.getElementById('{{$id_legend}}').innerHTML = myLine.generateLegend();
		}
		
		function reloadData_{{$_idbx}}(){
			$.ajax({
				url: "{{url('/api/nilai_pt_historik')}}",
				dataType: 'json',
				data: {
					'tahun': [
						$('#{{$id_tahun_mulai}}').val(),
						$('#{{$id_tahun_selesai}}').val(),
					]
				}
			}).done(function(response) {
				renderLineChart_{{$_idbx}}({
					labels: Object.keys(response),
					datasets: [
						{
							label: 'Nilai PT',
							borderColor: '#1ABC9C',
							backgroundColor: '#1ABC9C',
							borderWidth: 1.5,
							fill: false,
							data: Object.values(response),
							yAxisID: 'y-axis-1',
							pointRadius: 5,
							pointHoverRadius: 6,
						},
						{
							label: 'Status PT',
							fill: false,
							borderColor: '#F1C40F',
							borderWidth: 1,
							borderDash: [5, 5, 5],
							data: Object.values(response).map(function(){
								return 200;
							}),
							pointRadius: 0,
							pointHoverRadius: 0,
						},
						{
							label: 'Status PT',
							fill: false,
							borderColor: '#F1C40F',
							borderWidth: 1,
							borderDash: [5, 5, 5],
							data: Object.values(response).map(function(){
								return 300;
							}),
							pointRadius: 0,
							pointHoverRadius: 0,
						},
						{
							label: 'Status PT',
							fill: false,
							borderColor: '#F1C40F',
							borderWidth: 1,
							borderDash: [5, 5, 5],
							data: Object.values(response).map(function(){
								return 360;
							}),
							pointRadius: 0,
							pointHoverRadius: 0,
						},
					]
				})
			});
		}

		function handleInputChange_{{$_idbx}}() {
			let tahun_mulai = element_tahun_mulai.val();
			let tahun_selesai = element_tahun_selesai.val();
			if(tahun_mulai > tahun_selesai){
				element_tahun_mulai.val(tahun_selesai);
				element_tahun_selesai.val(tahun_mulai);
			}
			reloadData_{{$_idbx}}();
			sync_height();
		}
		let element_tahun_mulai = $('#{{$id_tahun_mulai}}');
		let element_tahun_selesai = $('#{{$id_tahun_selesai}}');
		element_tahun_mulai.on('change', handleInputChange_{{$_idbx}});
		element_tahun_selesai.on('change', handleInputChange_{{$_idbx}});

		$(document).ready(function(){
			reloadData_{{$_idbx}}();
		})
	</script>
