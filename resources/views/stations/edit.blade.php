@extends('layout.template')

@section('content')
    <form action="{!! route('stations.update', $station)!!} " method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PATCH"/>
        <fieldset>
            <label for="">Station Name: </label>
            <input type="text" name="name" value="{{ $station->name }}"/>
        </fieldset>
        <fieldset>
            <button type="submit">Save</button>
        </fieldset>
    </form>
@endsection