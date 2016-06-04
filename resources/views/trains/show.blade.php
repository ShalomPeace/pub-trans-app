@extends('layout.template')

@section('content')
    <p>Code: {{ $train->code }}</p>
    <p>Code: {{ $train->name }}</p>
    <p>Total Seats: {{ $train->totalSeats() }}</p>
    <a href="{!! route('trains.edit', $train) !!}">Edit Train</a>
@endsection