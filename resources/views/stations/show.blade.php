@extends('layout.template')

@section('content')
    <p>Station Name: {{ $station->name }}</p>
    <a href="{!! route('stations.edit', $station) !!}">Edit Station</a>
@endsectionRepos