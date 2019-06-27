<style>
	.flex-wrapper {
	  display: flex;
	  flex-flow: row nowrap;
	}

	.single-chart {
	  width: 100%;
	  margin: 0 auto;
	  justify-content: space-around ;
	}

	.circular-chart {
	  display: block;
	  margin: 0;
	  width: 100%;
	}

	.circle-bg {
	  fill: none;
	  stroke: #B6B6B6;
	   stroke-width: 3.1;
	}

	.circle {
	  fill: none;
	  stroke-width:2.8;
	  stroke-linecap: round; 
	  animation: progress 1s ease-out forwards;
	  -webkit-transition: all 0.5s; /* Safari */
  	  transition: all 0.5s;
	}

	@keyframes progress {
	  0% {
	    stroke-dasharray: 0 100;
	  }
	}

	.circular-chart.yellow .circle {
	  stroke: #FFCC00;
	}

	.circular-chart.green .circle {
	  stroke: #2386DE;
	}

	.circular-chart.red .circle {
	  stroke: #BF1E2E;
	}

	.circular-chart.yellow>.circle:hover{
		stroke-width:5.2;
		stroke:#FFE24E;
	}

	.circular-chart.green>.circle:hover {
		stroke-width:5.2;
	  stroke: #2386DE;
	}

	.circular-chart.red>.circle:hover {
		stroke-width:5.2;
	  stroke: #D9646F;
	}

	.percentage {
	  font-family: arial;
	  font-size: 0.35em;
	  text-anchor: middle;
	  font-weight: bold;
	}
	.percentage.red {fill: #BF1E2E}
	.percentage.yellow {fill: #FFCC00}
	.percentage.green {fill: #2386DE}

	.percentage_ket{
	  font-family: sans-serif;
	  font-size: 0.17em;
	  text-anchor: middle;
	  font-weight: bold;
	  fill: #666;
			
	}

	.txt-main{
		color: #A6A4BF;
		font-weight: bold;	
	}

</style>

	@php
		if(isset($tittle)){
	@endphp
	<h1 class="txt-main text-center">{{ $tittle }}</h1>
	@php
		}
	@endphp
	<div class="flex-wrapper">
		<div class="single-chart">
			@php
				if($skor>3){
					$class = 'green';
				}else if($skor <=3 && $skor >= 2){
					$class = 'yellow';
				}else{
					$class = 'red';
				}
				$value = ($skor*100/4) - 15;
			@endphp
		    <svg viewBox="2 2 32 32" class="circular-chart {{$class}}">
		      <path class="circle-bg"
		        d="M18 4.5845
		          a 13.4155 13.4155 0 0 1 0 26.831
		          a 13.4155 13.4155 0 0 1 0 -26.831"
			  />
		      <path class="circle"
		        stroke-dasharray="{{{ isset($value) ? ($value >= 0 ? $value : 0) : 0 }}}, 100"
		        d="M18 4.5845
		          a 13.4155 13.4155 0 0 1 0 26.831
		          a 13.4155 13.4155 0 0 1 0 -26.831"
		      />
		      @php
		      	if( $type==1){
		      @endphp
		      <text x="18" y="16.35" class="percentage_ket">{{{ isset($subtittle) ? $subtittle : '' }}}</text>
		      <text x="18" y="21.35" class="percentage {{ $class }}">{{{ isset($skor) ? $skor : '' }}}</text>
		      @php
		      	}else{
		      @endphp
		      <text x="18" y="21.25" class="percentage {{ $class }}" style="font-size:0.6em;">{{{ isset($skor) ? $skor : '' }}}</text>
		      @php
		      	}
		      @endphp
		    </svg>
		</div>
	</div>