@php
	$_idgau = rand(0, 999); 
@endphp
<div id="chart-gauge-half-{{$_idgau}}" class="chart-gauge-half" style="width:83%;"></div>


<script type="text/javascript" >
	var size = $("#chart-gauge-half-{{$_idgau}}").width()/2;//150,
    thickness = 12;
    if($(document).width()>1900){
    	thickness = 20;
    }
	//console.log(size);
	var color = d3.scaleLinear()
	    //.domain([0, 50, 100])
	    //.range(['#db2828', '#fbbd08', '#21ba45']);
	    //.domain([0, 365, 524, 681, 840])
	    .domain([0, 199, 200, 400])
	    .range(['#E53935', '#FE9D28', '#2386DE', '#2386DE']);

	var arc = d3.arc()
	    .innerRadius(size - thickness)
	    .outerRadius(size)
	    .startAngle(-Math.PI / 2);

	var svg = d3.select('#chart-gauge-half-{{$_idgau}}').append('svg')
	    .attr('width', size * 2)
	    .attr('height', size + 40)
	    .attr('class', 'gauge');


	var chart = svg.append('g')
	    .attr('transform', 'translate(' + size + ',' + size + ')')

	var background = chart.append('path')
	    .datum({
	        endAngle: Math.PI / 2
	    })
	    .attr('class', 'background smd-main-gauge-background')
	    .attr('d', arc);

	var foreground = chart.append('path')
	    .datum({
	        endAngle: -Math.PI / 2
	    })
	    .attr('class', 'smd-main-gauge-gaugeval')
	    .style('fill', '#db2828')
	    .attr('d', arc)
	    .style('stroke-linecap', 'round')
	    .style('stroke-linejoin', 'round');

	var value;


	/*var kete = svg.append('g')
	    .attr('transform', 'translate(' + size + ',' + (size * 1.05) + ')')
	    .append('text')
	    .text(0)
	    .attr('text-anchor', 'middle')
	    .attr('class', 'nhuruf');*/
	if($(document).width()>1900){
		value = svg.append('g').attr('transform', 'translate(' + size + ',' + (size * 1.00) + ')')
	    .append('text')
	    .text(0)
	    .attr('text-anchor', 'middle')
	    .attr('class', 'value smd-main-gauge-value');
	}else{
		value= svg.append('g').attr('transform', 'translate(' + size + ',' + (size * 1.15) + ')')
	    .append('text')
	    .text(0)
	    .attr('text-anchor', 'middle')
	    .attr('class', 'value smd-main-gauge-value');
	}

	


	var scale = svg.append('g')
	    .attr('transform', 'translate(' + size + ',' + (size + 25) + ')')
	    .attr('class', 'scale');

	scale.append('text')
	    .text(4)
	    .attr('text-anchor', 'middle')
	    .attr('x', (size - thickness / 2));

	scale.append('text')
	    .text(0)
	    .attr('text-anchor', 'middle')
	    .attr('x', -(size - thickness / 2));
	/*
	setInterval(function() {
	    update(Math.random() * 840);
	}, 1500);*/
	//update_gauge(500);

	update_gauge({{$value*100}});

	function update_gauge(v) {
	    v = d3.format('.1f')(v);
	    //console.log("update", v);
	    foreground.transition()
	        .duration(750)
	        .style('fill', function() {
	        	
	            return get_color(v);
	        })
	        .call(arcTween, v);

	    value.transition()
	        .duration(750)
	       	.style('fill', function(){
	       		
	            return get_color(v);
	       	})
	        .call(textTween, v);

	    /*kete.transition()
	        .duration(750)
	        .call(textKet, rentang(v));*/
	}

	function arcTween(transition, v) {
	    var newAngle = v / 400 * Math.PI - Math.PI / 2;
	    transition.attrTween('d', function(d) {
	        var interpolate = d3.interpolate(d.endAngle, newAngle);
	        return function(t) {
	            d.endAngle = interpolate(t);
	            return arc(d);
	        };
	    });
	}

	function textTween(transition, v) {
		//console.log(v);
	    transition.tween('text', function() {
	        var interpolate = d3.interpolate(this.innerHTML, v),
	            split = (v + '').split('.'),
	            //round = (split.length > 1) ? Math.pow(10, split[1].length) : 1;
	        	round = v/100;
	        return function(t) {
	            //this.innerHTML = d3.format('.1f')(Math.round(interpolate(t) * round) / round);
	            this.innerHTML = d3.format('.2f')(round);
	        };
	    });
	}

	function textKet(transition, v) {
		//console.log(v);
	    transition.tween('text', function() {
	        var interpolate = d3.interpolate(this.innerHTML, v),
	            split = (v + '').split('.'),
	            round = (split.length > 1) ? Math.pow(10, split[1].length) : 1;
	        return function(t) {
	            this.innerHTML = v//d3.format('.1f')(Math.round(interpolate(t) * round) / round);
	        };
	    });
	}

	function get_color(v){
		if(v>300){
			return '#2386DE';
		}else if(v <=300 && v >= 200){
			return '#D16D96';
		}else if(v <=200 && v >= 100){
			return '#FE8C00';
		}else{
			return '#ff0000';
		}
	}

	function rentang(v){
		v = Number(v);
		
		if(v<=840 && v>=682){
			return "Sangat Baik";
		}else if(v<=681 && v>=525){
			return "Baik";
		}else if(v<=524 && v>=366){
			return "Kurang";
		}else if(v<=365){
			return "Sangat Kurang";
		}else{
			return "#";
		}
	}
</script>
