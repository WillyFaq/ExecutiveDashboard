@extends('layouts.dashboard')
@section('page_heading','SDM')
@section('section')

<link rel="stylesheet" href="{{ asset("d3-chart/gauge.css") }}">
<script src="{{ asset("js/popper.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("d3-chart/d3.v5.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("js/Chart.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/utils.js") }}" type="text/javascript"></script>
<script src="{{ asset("js/apexcharts.js") }}" type="text/javascript"></script>

<div class="container container-main container-home" style="padding-top:10px;">
	<div class="row">
		<!-- group card top -->
		<div class="col-xs-12">
			<div class="row main-dash">
				<div class="col-xs-3">
					<div class="card">
						<div class="row">
							<div class="col-xs-12 card-home-title">
								<h2>Nilai SDM</h2>
							</div>
							<div class=" col-xs-12 ">
								<p class="txt_card_subtitle">Minimum :  3.50</p>
							</div>
						</div>
						<div class="row" style="padding-top:20px;">
							<div class="col-xs-12">
                    			@include('widgets.charts.gauge_sdm', array('value' => $skor_nilai_sdm))
							</div>
							<div class="col-xs-12">
								<div class="keterangan_box">
									<p><span class="dot d_info"></span> Baik</p>
									<p><span class="dot d_yellow"></span> Sedang</p>
									<p><span class="dot d_red"></span> Buruk</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				

				<div class="col-xs-6">
					<div class="card" style="padding-top:10px;">
						<div class="row">
							<div class="col-xs-7">
								<div class="row">
									<div class="col-xs-12 card-home-title">
										<h2>Jabatan Fungsional Dosen</h2>
									</div>
									<div class="col-xs-12 card-home-subtitle">
                                        <p class="txt_card_subtitle">{{ $periode }}</p>
									</div>
								</div>
							</div>
							<div class="col-xs-4 card-home-legend">
							</div>
							<div class="col-xs-1">
							</div>
								<div class="text-center card-sdm-right top-right pg_info">
									<p class="txt_card_subtitle">Skor</p>
                                    <h1>{{ $skor_jabatan_fungsional }}</h1>
								</div>
							<div class="col-xs-10 card-home-subtitle">
							</div>
							<div class="col-xs-2 text-center card-home-right">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12" style="padding-top:10px;">
                                @include('widgets.charts.mixchart_sdm', array('data' => [
                                    'bar' => ['Lektor Kepala', $dosen_lektor_kepala],
                                    'line'	=> ['Guru Besar', $dosen_guru_besar ],
                                ]))
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-xs-3">
					<div class="row sdm-small-card">
						<div class="col-xs-12">
							<div class="card">
								<div class="row">
									<div class="col-xs-8 sdm-small-card-tittle">
										<p>Rasio Dosen : Mahasiswa</p>
										<h1 class="txt_color_info">1 : {{ $rasio_dosen_mahasiswa }}</h1>
									</div>
									<div class="col-xs-4">
                                        @include('widgets.charts.gauge', array( 'value' => (3.15*100/4), 'skor'=> $skor_rasio_dosen_mahasiswa, 'type' => 2 ))
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="card">
								<div class="row">
									<div class="col-xs-8 sdm-small-card-tittle">
										<p>Rasio Program Studi : Dosen</p>
										<h1 class="txt_color_yellow">1 : {{ $rasio_prodi_dosen }}</h1>
									</div>
									<div class="col-xs-4">
                                        @include('widgets.charts.gauge', array( 'value' => (2.89*100/4), 'skor'=> $skor_rasio_prodi_dosen, 'type' => 2 ))
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="card">
								<div class="row">
									<div class="col-xs-8 sdm-small-card-tittle">
										<p>Tenaga Kependidikan</p>
										<div class="star-box">
                                            @for($i=1; $i <= 4; $i++)
                                                @if($i <= $skor_tenaga_kependidikan)
                                                    <img src="{{ asset("imgs/star-on.svg") }}" alt="On">
                                                @else
                                                    <img src="{{ asset("imgs/star-off.svg") }}" alt="Off">
                                                @endif
                                            @endfor
										</div>
									</div>
									<div class="col-xs-4">
                                        @include('widgets.charts.gauge', array( 'value' => (3*100/4), 'skor'=> $skor_tenaga_kependidikan, 'type' => 2 ))
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end group card top -->
		<!-- group card bottom -->
		<div class="col-xs-12">
			<div class="row main-dash">

				<div class="col-xs-3">
                    <div class="card"><div class="card-body"><div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12 card-home-title" style="margin-bottom:20px">
                                    <h2>Jabatan Fungsional Dosen</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 card-home-legend">
                            <ul>
                                <li><span class="dot d_red"></span>Guru Besar : <strong>{{ array_sum(array_values($dosen_guru_besar)) }} Orang</strong> </li>
                                <li><span class="dot d_yellow"></span>Lekor Kepala : <strong>{{ array_sum(array_values($dosen_lektor_kepala)) }} Orang</strong> </li>
                            </ul>
                        </div>
                        <div class="col-xs-12" style="margin-bottom:30px"></div>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12 card-home-title" style="margin-bottom:20px">
                                    <h2>Persentase Sertifikat Pendidikan</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 card-home-legend">
                            <ul>
                                <li><span class="dot d_red"></span>Dosen Tetap : <strong>{{ array_sum(array_values($dosen_tetap)) }} Orang</strong> </li>
                                <li><span class="dot d_yellow"></span>Sertifiakat : <strong>{{ array_sum(array_values($dosen_tetap_bersertifikasi)) }} Orang</strong> </li>
                            </ul>
                        </div>
                    </div></div></div>
				</div>

				<div class="col-xs-6">
					<div class="card" style="padding-top:10px;">
						<div class="row">
							<div class="col-xs-7">
								<div class="row">
									<div class="col-xs-12 card-home-title">
										<h2>Persentase Sertifikat Pendidikan</h2>
									</div>
									<div class="col-xs-12 card-home-subtitle">
										<p class="txt_card_subtitle">{{ $periode }}</p>
									</div>
								</div>
							</div>
							<div class="col-xs-4 card-home-legend">
							</div>
							<div class="col-xs-1">
							</div>
								<div class="text-center card-sdm-right top-right pg_warning">
									<p class="txt_card_subtitle">Skor</p>
                                    <h1>{{ $skor_sertifikat_pendidikan }}</h1>
								</div>
							<div class="col-xs-10 card-home-subtitle">
							</div>
							<div class="col-xs-2 text-center card-home-right">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12" style="padding-top:10px;">
                                @include('widgets.charts.mixchart_sdm', array('data' => [
                                    'bar' => ['Sertifikasi', $dosen_tetap_bersertifikasi],
                                    'line'	=> ['Dosen Tetap', $dosen_tetap ],
                                ]))
							</div>
						</div>
					</div>
				</div>
				

				<div class="col-xs-3">
					<div class="card">
						<div class="row">
							<div class="col-xs-10 card-home-title">
								<h2>Persentase Dosen Tidak Tetap</h2>
							</div>
							<div class="col-xs-2 text-center card-home-right">
                                <h1 class="txt_color_info">{{ $skor_presentase_dosen_tidak_tetap }}</h1>
								<p class="txt_card_subtitle">Skor</p>
							</div>
						</div>
						<div class="row" style="padding-top:20px;">
							<div class="col-xs-12">
								@include('widgets.charts.cpiechart', ['data' => [
									'Dosen Tetap' => $jml_dosen_tetap,
									'Dosen Tidak Tetap' => $jml_dosen_tidak_tetap,
								]])
							</div>
							<div class="col-xs-12 card-home-legend">
									<ul>
										<li><span class="dot d_red"></span>Dosen Tetap : <strong>{{ $jml_dosen_tetap }} Orang</strong> </li>
										<li><span class="dot d_yellow"></span>Dosen Tidak Tetap : <strong>{{ $jml_dosen_tidak_tetap }} Orang</strong> </li>
									</ul>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end group card bottom -->
	</div>
</div>


@stop
