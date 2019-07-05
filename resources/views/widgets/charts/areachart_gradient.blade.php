@php
	$_idbx = rand(0, 999); 
@endphp
<div class="m-auto" style="height:123px;">
    <div id="chart_{{$_idbx}}"></div>
</div>
<script type="text/javascript">
    let h = 86;
    let w = 150;
    // var h = 100;
    // var w = 150;
    // if($(document).width()>1900){
    //     h = 140;
    //     w = 200;
    // }
	var options_{{$_idbx}} = {
        chart: {
            height: h,
            width: w,
            type: 'area',
            zoom: {
                enabled: false
            },
            toolbar: {
            	show: false,
            }
        },
        colors:['#16A085'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 1,
        },
        series: [{
            data: {!! json_encode(array_values($data)) !!}
        }],
        labels: {!! json_encode(array_keys($data)) !!},
        fill: {
	   		type: 'gradient',
	        gradient: {
	          	shadeIntensity: 1,
	          	opacityFrom: 0.7,
	          	opacityTo: 0.9,
	          	stops: [0, 90, 100]
	        }
	  	},
	  	grid: {
			show: false
		},
        xaxis: {
        	type: 'text',
            axisBorder: {
	            show: true,
	        },
	        labels: {
            	show: false,
	        },
        },
        yaxis: {
            show: false
        },
        tooltip: {
        	enabled: false
        },
        legend: {
		    show: true,
		    height:0
		}
    }

    var chart_{{$_idbx}} = new ApexCharts(
        document.querySelector("#chart_{{$_idbx}}"),
        options_{{$_idbx}}
    );

    chart_{{$_idbx}}.render();
</script>
