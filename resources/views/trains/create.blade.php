@extends('layout.template')

@section('content')
    <form action="{!! route('trains.store') !!}" method="POST">
        {!! csrf_field() !!}
        <fieldset>
            <label for="">Code: </label>
            <input type="text" name="code" value="TRN0001"/>
        </fieldset>
        <fieldset>
            <label for="">Name: </label>
            <input type="text" name="name"/>
        </fieldset>
        <fieldset>
            <label for="">Total Seats</label>
            <input type="number" name="total_seats"/>
        </fieldset>
        <fieldset>
            <button type="submit">Add Train</button>
        </fieldset>
    </form>
@endsection