@extends('layouts.refactored.dashboard')
@section('page_heading','Dashboard')
@section('section')
<style>
    #home-section .top-row .card{
        height: 328px;
    }
    #home-section .bottom-row .card{
        height: 325px;
    }
    #home-section .right-col > .card{
        background-color: #BDC3C7;
        border-color: #BDC3C7;
    }
    #home-section .right-col > .card > .card-body{
        padding: 10px;
    }
    #home-section .right-col .top-row .card {
        height: 318px;
    }
    #home-section .right-col .bottom-row .card {
        height: 318px;
    }
    .nama-pt {
        font-size: 14pt;
        font-weight: bold;
        color: black;
        line-height: 20px;
    }
    .detail-pt {
        font-size: 13px;
    }
</style>
<div class="row" id="home-section">
    <div class="col-lg-9 left-col mb-3">
        <div class="row top-row mb-3">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
        <div class="row bottom-row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body"></div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col right-col">
        <div class="card">
            <div class="card-body">
                <div class="row top-row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body"></div>
                        </div>
                    </div>
                </div>
                <div class="row bottom-row">
                    <div class="col">
                        <div class="card mt-3">
                            <div class="card-body"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
