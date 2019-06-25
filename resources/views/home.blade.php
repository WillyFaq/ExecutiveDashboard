@extends('layouts.refactored.dashboard')
@section('page_heading','Dashboard')
@section('section')
<style>
    #home-section .top-row > * > .card{
        min-height: 328px;
    }
    #home-section .bottom-row > * > .card{
        min-height: 325px;
    }
    #home-section .right-col > .card{
        background-color: #BDC3C7;
        border-color: #BDC3C7;
    }
    #home-section .right-col > .card > .card-body{
        padding: 10px;
    }
    #home-section .right-col .top-row .card {
        min-height: 318px;
    }
    #home-section .right-col .bottom-row .card {
        min-height: 318px;
    }
</style>
<div class="row" id="home-section">
    <div class="col-lg-9 left-col">
        <div class="row top-row">
            <div class="col-md-5 mb-20px">
                @include('component_home.skor')
            </div>
            <div class="col-md-7 mb-20px">
                @include('component_home.nilai_pt')
            </div>
        </div>
        <div class="row bottom-row">
            <div class="col-md-5 mb-20px">
                @include('component_home.kriteria_khusus_unggul')
            </div>
            <div class="col-md-7 mb-20px">
                @include('component_home.kriteria_pt')
            </div>
        </div>
    </div>
    <div class="col right-col">
        <div class="card">
            <div class="card-body">
                <div class="row top-row">
                    <div class="col mb-20px">
                        @include('component_home.penmaru_pendaftar')
                    </div>
                </div>
                <div class="row bottom-row">
                    <div class="col">
                        @include('component_home.penmaru_registrasi')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
