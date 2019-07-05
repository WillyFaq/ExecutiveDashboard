@extends('layouts.refactored.dashboard')
@section('page_heading','Dashboard')
@section('section')
<style>
    #home-section .top-row > * > .card{
        min-height: 467px;
    }
    #home-section .bottom-row > * > .card{
        min-height: 467px;
    }
    #home-section .right-col > .card{
        background-color: #BDC3C7;
        border-color: #BDC3C7;
    }
    #home-section .right-col > .card > .card-body{
        padding: 15px;
    }
    #home-section .right-col .card:first-child {
        min-height: 455px;
    }
    #home-section .right-col .card:not(:first-child) {
        min-height: 455px;
    }
</style>
<div class="row" id="home-section">
    <div class="col-lg-9 col-md-12 left-col">
        <div class="row top-row">
            <div class="col-md-5">
                @include('component_home.skor')
            </div>
            <div class="col-md-7">
                @include('component_home.nilai_pt')
            </div>
        </div>
        <div class="row bottom-row">
            <div class="col-md-5">
                @include('component_home.kriteria_khusus_unggul')
            </div>
            <div class="col-md-7">
                @include('component_home.kriteria_pt')
            </div>
        </div>
    </div>
    <div class="col-lg-3 right-col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        @include('component_home.penmaru_pendaftar')
                    </div>
                    <div class="col">
                        @include('component_home.penmaru_registrasi')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
