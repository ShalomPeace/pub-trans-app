@extends('layout.template')

@section('content')
	<form action="" method="POST">
		<fieldset>
			<label>Departure Station</label>
			<select>
				<option>Station 1</option>
				<option>Station 2</option>
				<option>Station 3</option>
			</select>
		</fieldset>
		<fieldset>
			<label>Arrival Station</label>
			<select>
				<option>Station 1</option>
				<option>Station 2</option>
				<option>Station 3</option>
			</select>
		</fieldset>
		<fieldset>
			<button type="submit">Search Schedules</button>
		</fieldset>
	</form>
@endsection