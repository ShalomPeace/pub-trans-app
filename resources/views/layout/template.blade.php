<!DOCTYPE html>
<html lang="en" ng-app="App">
<head>
    <base href="{!! route('index') !!}/"/>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Public Transportation App (Train Scheduling)</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css"/>
</head>
<body>
	<div id="wrapper" ng-cloak>
        @include('layout.header')
        @include('layout.navigation')
		<div id="container" class="container">
            <section class="row">
                <div class="col s12">
                    @yield('content')
                </div>
            </section>
		</div>
	</div>
    <script type="text/javascript" src="js/libs.min.js"></script>
    <script type="text/javascript" src="js/app.min.js"></script>
</body>
</html>