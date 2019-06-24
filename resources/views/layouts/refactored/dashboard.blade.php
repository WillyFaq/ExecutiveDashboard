@extends('layouts.refactored.plane')
@section('body')
<div id="wrapper">
    <nav class="navbar navbar-expand navbar-light bg-white topbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('')}}">
                <img src="{{asset('imgs/logo_stikom_warna.PNG')}}" height="43" alt="">
            </a>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 text-gray-600 small">
                            Pantjawati S.
                        </span>
                        <img class="img-profile rounded-circle" src="{{asset('imgs/890026.jpg')}}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="container-fluid pt-3">
    @yield('section')
</div>
@stop
