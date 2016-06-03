@extends('layout.template')

@section('content')
    <form action="{!! route('stations.store') !!}" method="POST">
        {!! csrf_field() !!}
        <fieldset>
            <label for="">Station Name</label>
            <input type="text" name="name"/>
        </fieldset>
        <fieldset>
            <button type="submit">Add Station</button>
        </fieldset>
    </form>
@endsection