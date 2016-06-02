<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Public Transportation App (Train Scheduling)</title>
</head>
<body>
	<div id="wrapper">
		<div id="container">
			<h2>Public Transportation App (Train Scheduling)</h2>
			@if (auth()->check())
				@include('layout.navigation')
			@endif
			@yield('content')
		</div>
	</div>
</body>
</html>