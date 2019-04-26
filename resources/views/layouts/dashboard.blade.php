@extends('layouts.plane')

@section('body')
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('') }}">
                    <img src="{{ asset("imgs/logo_stikom_warna.png") }}" alt="Stikom" class="img-web">
                </a>
                <p class="brand-text">@yield('page_heading')</p>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                
                <li class="dropdown">
                    <a class="dropdown-toggle prof-box" data-toggle="dropdown" href="#">
                        <span style="color:#6B779E;">John Doe</span>  <i class="fa fa-angle-down"></i> 
                        <img src="{{ asset("imgs/a.jpg") }}" alt="Profile Pic" class="img-profil-pic">
                    </a>
                    
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url ('login') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                        </li>
                        <li>
                            <a {{ (Request::is('/') ? 'class=active' : '') }} href="{{ url ('/') }}"><i class="fa fa-bar-chart-o fa-2x fa-fw"></i> Dashboard</a>
                        </li>
                        <li >
                            <a href="{{ url ('mahasiswa') }}"><i class="fa fa-graduation-cap fa-2x fa-fw"></i> Mahasiswa</a>
                        </li>
                        <li >
                            <a {{ (Request::is('*sdm') || Request::is('*sdm/*') ? 'class=active' : '') }} href="{{ url ('sdm') }}"><i class="fa fa-briefcase fa-fw"></i> SDM</a>
                        </li>
                        <li >
                            <a href="{{ url ('peneliian') }}">&nbsp;<i class="fa fa-file-text"></i>&nbsp;  Penelitian</a>
                        </li>
                        <li >
                            <a href="{{ url ('inovasi') }}"><i class="fa fa-pencil fa-fw"></i> Inovasi</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			@yield('section')
            <!-- <div class="row">  
            </div> -->
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop

