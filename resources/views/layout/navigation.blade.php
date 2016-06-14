<ul id="side-nav" class="side-nav">
	<li>
		<a href="{!! route('index') !!}">Home</a>
	</li>
	<li>
		<a href="{!! route('schedules.index') !!}">Schedules</a>
	</li>
	<li>
		<a href="{!! route('stations.index') !!}">Stations</a>
	</li>
	@if (auth()->check())
		<li>
			<a href="{!! route('trains.index') !!}">Trains</a>
		</li>
		<li>
			<a href="{!! route('operators.index') !!}">Operators</a>
		</li>
		<li>
			<a href="{!! route('logout') !!}">Logout</a>
		</li>
	@else
		<li>
			<a href="{!! route('login') !!}">Login</a>
		</li>
	@endif
</ul>