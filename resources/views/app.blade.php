<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="minimum-scale=1, initial-scale=1, width=device-width, shrink-to-fit=no"/>
	<title>{{ config('app.name') }}</title>
	
	<!-- Scripts -->
	<script src="{{ mix('js/app.js') }}" defer></script>
	
	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather|Roboto:400">
	<link rel="stylesheet" href="https://unpkg.com/ionicons@4.2.2/dist/css/ionicons.min.css">
	
	<!-- Styles -->
	<link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<style>
	#app {
		display: flex;
		flex-direction: column;
		height: 100vh;
	}
</style>
<body>
	<div id="app"/>
</body>
</html>