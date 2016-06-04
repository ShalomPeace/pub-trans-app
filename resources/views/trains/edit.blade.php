@extends('layout.template')

@section('content')
    <form action="{!! route('trains.update', $train) !!}" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PATCH"/>
        <fieldset>
            <label for="">Code: </label>
            <input type="text" name="code" value="{{ $train->code }}" readonly/>
        </fieldset>
        <fieldset>
            <label for="">Name: </label>
            <input type="text" name="name" value="{{ $train->name }}"/>
        </fieldset>
        <fieldset>
            <label for="">Total Seats</label>
            <input type="number" name="total_seats" value="{{ $train->total_seats }}"/>
        </fieldset>
        <fieldset>
            <button type="submit">Save</button>
        </fieldset>
    </form>
@endsection