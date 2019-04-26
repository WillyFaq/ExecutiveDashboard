@extends('layouts.dashboard')
@section('page_heading','SDM')
@section('section')
	<nav class="navbar navbar-default tabar">
	  	<div class="container-fluid">
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      	<ul class="nav navbar-nav nav-tabar">
			        <li {{ (Request::is('sdm') ? 'class=active' : '') }} ><a href="{{ url('/sdm') }}">Utama</a></li>
			        <li {{ (Request::is('*profil*') ? 'class=active' : '') }} ><a href="{{ url('/sdm/profil') }}">Profile Dosen</a></li>
			        <li {{ (Request::is('*beban_kerja') ? 'class=active' : '') }} ><a href="{{ url('/sdm/beban_kerja') }}">Beban Kerja Dosen</a></li>
			        <li {{ (Request::is('*produktivitas') ? 'class=active' : '') }} ><a href="{{ url('/sdm/produktivitas') }}">Produktivitas</a></li>
		      	</ul>
		    </div><!-- /.navbar-collapse -->
	  	</div><!-- /.container-fluid -->
	</nav>
	<div class="container container-main">
		@yield('sub_section')
	</div>

@stop
