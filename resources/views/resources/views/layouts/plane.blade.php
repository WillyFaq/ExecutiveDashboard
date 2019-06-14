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
    <link href="{{ asset("css/bootstrap.css") }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset("css/metisMenu.css") }}" rel="stylesheet">
	
    <!-- Nunito sans Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset("css/new_style.css") }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset("css/font-awesome.css") }}" rel="stylesheet" type="text/css">
	<script src="{{ asset("js/jquery.js") }}" type="text/javascript"></script>
</head>
<body>
	@yield('body')
	
	<script src="{{ asset("js/bootstrap.js") }}" type="text/javascript"></script>
	<script src="{{ asset("js/metisMenu.js") }}" type="text/javascript"></script>
	
	<script src="{{ asset("js/sb-admin-2.js") }}" type="text/javascript"></script>
</body>
</html>