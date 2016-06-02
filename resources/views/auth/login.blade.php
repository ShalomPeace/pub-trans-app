@extends('layout.template')

@section('content')
	<form action="{!! route('login.attempt') !!}" method="POST">
		{!! csrf_field() !!}
		<fieldset>
			<label>Username</label>
			<input type="text" name="username">
		</fieldset>
		<fieldset>
			<label>Password</label>
			<input type="password" name="password">
		</fieldset>
		<fieldset>
			<button type="submit">Login</button>
		</fieldset>
	</form>
@endsection