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
                    <img src="{{ asset("imgs/logo_stikom_warna.PNG") }}" alt="Stikom" class="img-web">
                </a>
                <!-- <p class="brand-text">@yield('page_heading')</p> -->
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                
                <li class="dropdown">
                    <a class="dropdown-toggle prof-box" data-toggle="dropdown" href="#">
                        <span style="color:#6B779E;">Pantjawati S.</span>  <i class="fa fa-angle-down"></i> 
                        <img src="{{ asset("imgs/b.png") }}" alt="Profile Pic" class="img-profil-pic">
                    </a>
                    
                    <ul class="dropdown-menu dropdown-user">
                        <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li> 
                        <li class="divider"></li>
                        -->
                        <li><a href="{{ url ('login') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

        </nav>

        <div id="page-wrapper">
			@yield('section')
            <!-- <div class="row">  
            </div> -->
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop

