<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title','default')</title>
	<!--link href="css/estilos_pdf.css" rel="stylesheet" type="text/css" -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class='body'>
	<div class='contenido'>
		@yield('content') 
	</div>
	@yield('style')
</body>
</html>
		   <!--
		   		<style>
		.body {
		   	background-image: url("images/watermark.gif");
		   	background-position: center; /* Center the image */
		   	height: 1500px; /* You must set a specified height */
  			background-position: center; /* Center the image */
		   	background-size: auto;
		}
	</style>
background="{{ asset('images/watermark.gif') }}" 
		   	background-repeat: no-repeat;-->
