@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 l8 offset-l2">
            <section class="widget">
                <main class="widget-body">
                    <section class="row">
                        <div class="col s12">
                            <a href="{!! route('trains.create') !!}" class="btn btn-small btn-info right">Add Train</a>
                        </div>
                    </section>
                    <table>
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Total Seats</th>
                                <th>Date Added</th>
                                <th>&nbsp;</th>
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
                                        <td class="right-align">
                                            <a href="{!! route('trains.show', $train) !!}">View</a>
                                            <a href="{!! route('trains.edit', $train) !!}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" align="center">No train found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </main>
            </section>
        </div>
    </section>
@endsection