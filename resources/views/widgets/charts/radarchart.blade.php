<div class="m-auto home-radarchart" style="position:relative; height:348px">
	<canvas id="radarchart"></canvas>
</div>

<script>
    @php
        $label = array_map(function($data_profil) {
            return [
                $data_profil['nama'],
                number_format($data_profil['nilai'],2),
            ];
        }, $data_profil);
        $data = array_map(function($data_profil) {
            return $data_profil['nilai'];
        }, $data_profil);
    @endphp
    var label = {!! json_encode(array_values($label)) !!};
    var data = {!! json_encode(array_values($data)) !!};

    /*   Warna label */
    var index = 0;
    var value = data[0];
    var labelColor = [];
    for (var i = 1; i < data.length; i++) {
      	if (data[i] < value) {
        	value = data[i];
        	index = i;
      	}
      	labelColor.push("#000000");
    }
    labelColor[index] = "#FF0000";

		var color = Chart.helpers.color;
		var config = {
			type: 'radar',
			data: {
				labels: label,
				datasets: [{
					label: 'Kriteria Perguruan Tinggi',
					backgroundColor: 'rgba(26, 188, 156, 0.5)',//color(window.chartColors.red).alpha(0.2).rgbString(),
					// borderColor: '#1ABC9C',//window.chartColors.red,
					borderWidth: 0,
					pointBackgroundColor: '#1ABC9C',//window.chartColors.red,
					data: data,
					pointRadius: 5,
					pointHoverRadius: 7,
				}]
			},
			options: {
				maintainAspectRatio: false,
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
                    	fontColor: labelColor,
						fontSize: 11,
						// callback: function(value, index, values) {
						// 	return value;
						// }
					},
					ticks: {
						min: 0,
						max: 4,
						stepSize: 1,
						callback: function(value){
							return value.toFixed(2);
						}
					}
				}
			},
			// plugins: [
			// 	{
			// 		beforeDraw: function(chart){
			// 			foreach(chart.scale.ctx as chart){

			// 			}
			// 		}
			// 	}
			// ]
		};
		$(document).ready(function(){
            let chartElement = document.getElementById('radarchart');
            let chartContext = chartElement.getContext('2d');
            window.myRadar = new Chart(chartContext, config);
            chartElement.onclick = function(e){
                /*console.log(e);
                let dot = window.myRadar.getElementAtEvent(e);
                if(!dot.length) return;
                console.log(dot);
                window.location.href = label[dot[0]._index][0].replace(' ','_').toLowerCase();
				*/
				var helpers = Chart.helpers;

			    var eventPosition = helpers.getRelativePosition(e, window.myRadar.chart);
			    var mouseX = eventPosition.x;
			    var mouseY = eventPosition.y;

			    var activePoints = [];
			    // loop through all the labels
			    helpers.each(window.myRadar.scale.ticks, function (label, index) {
			    	var valueCount = this.pointLabels.length;
			        for (var i = valueCount - 1; i >= 0; i--) {
			            // here we effectively get the bounding box for each label
			            var pointLabelPosition = this.getPointPosition(i, this.getDistanceFromCenterForValue(this.options.reverse ? this.min : this.max) + 5);

			            var pointLabelFontSize = helpers.getValueOrDefault(this.options.pointLabels.fontSize, Chart.defaults.global.defaultFontSize);
			            var pointLabeFontStyle = helpers.getValueOrDefault(this.options.pointLabels.fontStyle, Chart.defaults.global.defaultFontStyle);
			            var pointLabeFontFamily = helpers.getValueOrDefault(this.options.pointLabels.fontFamily, Chart.defaults.global.defaultFontFamily);
			            var pointLabeFont = helpers.fontString(pointLabelFontSize, pointLabeFontStyle, pointLabeFontFamily);
			            chartContext.font = pointLabeFont;

			            var labelsCount = this.pointLabels.length,
			                halfLabelsCount = this.pointLabels.length / 2,
			                quarterLabelsCount = halfLabelsCount / 2,
			                upperHalf = (i < quarterLabelsCount || i > labelsCount - quarterLabelsCount),
			                exactQuarter = (i === quarterLabelsCount || i === labelsCount - quarterLabelsCount);
			            var width = chartContext.measureText(this.pointLabels[i]).width;
			            var height = pointLabelFontSize;

			            var x, y;

			            if (i === 0 || i === halfLabelsCount)
			                x = pointLabelPosition.x - width / 2;
			            else if (i < halfLabelsCount)
			                x = pointLabelPosition.x;
			            else
			                x = pointLabelPosition.x - width;

			            if (exactQuarter)
			                y = pointLabelPosition.y - height / 2;
			            else if (upperHalf)
			                y = pointLabelPosition.y - height;
			            else
			                y = pointLabelPosition.y

			            // check if the click was within the bounding box
			            if ((mouseY >= y && mouseY <= y + height) && (mouseX >= x && mouseX <= x + width))
			                activePoints.push({ index: i, label: this.pointLabels[i] });
			        }
			    }, window.myRadar.scale);

			    var firstPoint = activePoints[0];
			    if (firstPoint !== undefined) {
			        //alert(firstPoint.index + ': ' + firstPoint.label);
			    	var lab = firstPoint.label;
			    	//console.log(lab[0].toLowerCase());
			    	window.location.href=lab[0].toLowerCase();
			    }
			}
		});

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
