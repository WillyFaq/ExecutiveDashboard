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
    <script src="{{ asset("js/font-awesome.all.min.js") }}" type="text/javascript"></script>
    <script type="text/javascript">
    FontAwesome.library.add(
        {
            prefix: 'fac',
            iconName: 'arrow-up-thin',
            icon: [24, 24, [], 'e001', 'M4,12l1.41,1.41L11,7.83V20h2V7.83l5.58,5.59L20,12,12,4Z']
        }
    );
    FontAwesome.library.add(
        {
            prefix: 'fac',
            iconName: 'arrow-down-thin',
            icon: [24, 24, [], 'e002', 'M4,12l1.41,1.41L11,7.83V20h2V7.83l5.58,5.59L20,12,12,4Z']
        }
    );
    FontAwesome.library.add(
        {
            prefix: 'fac',
            iconName: 'download',
            icon: [24, 24, [], 'e003', 'M11.5,9A2.5,2.5,0,1,0,14,11.5,2.5,2.5,0,0,0,11.5,9ZM20,4H4A2.006,2.006,0,0,0,2,6V18a2.006,2.006,0,0,0,2,2H20a2.006,2.006,0,0,0,2-2V6A2.006,2.006,0,0,0,20,4ZM16.79,18.21,13.88,15.3a4.434,4.434,0,0,1-2.39.7,4.529,4.529,0,1,1,3.81-2.11l2.91,2.9-1.42,1.42Z']
        }
    );
    </script>
    @yield('body')
</body>
</html>
