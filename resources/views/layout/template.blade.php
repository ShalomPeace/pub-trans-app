<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{!! config('app.url') !!}"/>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Public Transportation App (Train Scheduling)</title>
    <link rel="stylesheet" href="css/app.css"/>
</head>
<body>
	<div id="wrapper">
        @include('layout.header')
		<div id="container" class="container">
            <section class="row">
                <div class="col s12">
                    @yield('content')
                </div>
            </section>
		</div>
	</div>
    <script type="text/javascript" src="js/libs.min.js"></script>
</body>
</html>