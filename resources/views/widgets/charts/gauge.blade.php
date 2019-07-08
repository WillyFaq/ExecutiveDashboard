@php
	$_idbx = rand(0, 999); 

	$diameter = 102;
	$stroke_width = $diameter/10;
	$rad = ($diameter/2)-($stroke_width/2);
	$keliling = 2*M_PI*$rad;
	$value = ceil((1-($skor/4))*100)/100;
	$progress = ceil($keliling*$value);
@endphp
<style>
	#gauge_{{$_idbx}} circle{
		transform: rotate(-90deg) translateX(-{{$diameter}}px);
	}
	#gauge_{{$_idbx}} circle.bg{
		stroke: #ddd;
	}
	#gauge_{{$_idbx}} circle.danger{
		stroke: red;
	}
	#gauge_{{$_idbx}} circle.warning{
		stroke: #FE8C00;
	}
	#gauge_{{$_idbx}} circle.success{
		stroke: #D16D96;
	}
	#gauge_{{$_idbx}} circle.primary{
		stroke: #2386DE;
	}
	#gauge_{{$_idbx}} text.skor {
		font-size: 24px;
		font-weight: bold;
		text-anchor: middle;
	}
	#gauge_{{$_idbx}} text.skor.danger {
		fill: red;
	}
	#gauge_{{$_idbx}} text.skor.warning {
		fill: #FE8C00;
	}
	#gauge_{{$_idbx}} text.skor.success {
		fill: #D16D96;
	}
	#gauge_{{$_idbx}} text.skor.primary {
		fill: #2386DE;
	}
</style>
<svg width="{{$diameter}}" height="{{$diameter}}" viewbox="0 0 {{$diameter}} {{$diameter}}" id="gauge_{{$_idbx}}">
	<circle cx="{{$diameter/2}}" cy="{{$diameter/2}}" r="{{$rad}}" fill="none" class="bg" stroke-width="{{$stroke_width}}" />
	<circle cx="{{$diameter/2}}" cy="{{$diameter/2}}" r="{{$rad}}" fill="none" class="progress_value {{$class_name}}" stroke-width="{{$stroke_width}}" stroke-dasharray="{{$keliling}}" stroke-dashoffset="{{$progress}}"/>
	<text x="{{$diameter/2}}" y="{{($diameter/2)+7}}" class="skor {{$class_name}}">{{{ isset($skor) ? $skor : '' }}}</text>
</svg>
