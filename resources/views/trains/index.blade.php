@extends('layout.template')

@section('content')
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Total Seats</th>
                <th>Date Added</th>
                <th>Added By</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if ( ! $trains->isEmpty())
                @foreach ($trains as $train)
                    <tr>
                        <td>{{ $train->code }}</td>
                        <td>{{ $train->name }}</td>
                        <td>{{ $train->totalSeats() }}</td>
                        <td>{{ $train->created_at->format('F j, Y') }}</td>
                        <td>{{ $train->user->name }}</td>
                        <td>
                            <a href="{!! route('trains.show', $train) !!}">View</a>
                            <a href="{!! route('trains.edit', $train) !!}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" align="center">No train found.</td>
                </tr>
            @endif
        </tbody>
    </table>
    <a href="{!! route('trains.create') !!}">Add Train</a>
@endsection