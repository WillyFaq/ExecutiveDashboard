<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>Executive Dashboard</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<link rel="shortcut icon" href="{{ asset("imgs/icon-stikom.png") }}" />
	<!-- Bootstrap Core CSS -->
    <link href="{{ asset("css/bootstrap.v4.3.1.min.css") }}" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="{{ asset("css/metisMenu.css") }}" rel="stylesheet">
    <!-- Nunito sans Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{ asset("css/font-awesome.css") }}" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="{{ asset("css/sb-admin-2.v4.0.6.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/dashboard-executive.css") }}" rel="stylesheet">
</head>
<body>
    <script src="{{ asset("js/jquery.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("js/bootstrap.bundle.v4.3.1.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("js/metisMenu.js") }}" type="text/javascript"></script>
    <script src="{{ asset("js/sb-admin-2.v4.0.6.min.js") }}" type="text/javascript"></script>
	<script src="{{ asset("js/Chart.bundle.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("js/chartjs-plugin-datalabels.min.js") }}" type="text/javascript"></script>
    <script>
        // Chart.defaults.global.plugins.datalabels.display = false
        Chart.plugins.unregister(ChartDataLabels);
    </script>
    @yield('body')
</body>
</html>
