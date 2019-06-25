<style>
	/* .flex-wrapper {
	  display: flex;
	  flex-flow: row nowrap;
		padding: 20px 20px 20px 50px;
	} */

	.single-chart {
	  width: 90%;
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
	  stroke: rgba(255, 255, 255, 0.7);
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

	.circular-chart.white .circle{
		stroke:#FFF;
	}
	.circular-chart.white>.circle:hover {
		stroke-width:3.2;
		stroke:#FFF;
	}

	.percentage {
	  font-family: arial;
	  font-size: 0.35em;
	  text-anchor: middle;
	  font-weight: bold;
	  fill: #FFF;
	}
	.percentage.white {}

	.percentage_ket{
	  font-family: sans-serif;
	  font-size: 0.2em;
	  text-anchor: middle;
	  font-weight: bold;
	  fill: #FFF;
			
	}

	.txt-main{
		color: #FFF;
		font-weight: bold;	
	}

  	.cluster-circle{
  		-webkit-box-shadow: 10px 10px 213px 200px rgba(0,0,0,0.75);
		-moz-box-shadow: 10px 10px 213px 200px rgba(0,0,0,0.75);
		box-shadow: 10px 10px 213px 200px rgba(0,0,0,0.75);
  	}
  	.cluster{
	  font-family: sans-serif;
	  font-size: 0.24em;
	  text-anchor: middle;
	  font-weight: bold;
	  fill: #FFF;
	  }
	.cluster-circle.unggul{
		fill: #41B9FE;
	}
	.cluster-circle.baik_sekali{
		fill: #BA7AA4;
	}
	.cluster-circle.baik{
		fill: #FE8E16;
	}
	.cluster-circle.tidak_terakreditasi{
		fill: #FF5A79;
	}

</style>
	<div class="flex-wrapper">
		<div class="single-chart">
			@php
				$clus_position = array(
					1 => ['cx=31.3 cy=19','x=31.3 y=20'],
					2 => ['cx=18 cy=31.5','x=18 y=32.5'],
					3 => ['cx=4.5 cy=19','x=4.5 y=20'],
					4 => ['cx=18 cy=4.5','x=18 y=5'],
				);

				$class = 'white';
				$clus = $value;
				$value = ($value==4)?100:($value*100/4) - ($value*5);
			@endphp
		    <svg viewBox="1 2 32 32" class="circular-chart white">
		      	<path class="circle-bg"
		        	d="M18 4.5845
			          a 13.4155 13.4155 0 0 1 0 26.831
			          a 13.4155 13.4155 0 0 1 0 -26.831"
		      		/>
		      	<path class="circle"
			        stroke-dasharray="{{$value}}, 100"
			        d="M18 4.5845
			          a 13.4155 13.4155 0 0 1 0 26.831
			          a 13.4155 13.4155 0 0 1 0 -26.831"
		      	/>
		      	<g>
	            	<circle {{ $clus_position[$clus][0] }} r="3" stroke="#EEE" stroke-width="0.7" class="cluster-circle {{ $status }}"/> 
	            	<text {{$clus_position[$clus][1]}} text-anchor="middle" class="cluster" >{{$clus}}</text>
          		</g>
			    <text x="18" y="15.35" class="percentage_ket">Peringkat</text> 
			    <text x="18" y="23.25" class="percentage" style="font-size:0.6em;">{{{ isset($skor) ? $skor : '' }}}</text>
		    </svg>
		</div>
	</div>
