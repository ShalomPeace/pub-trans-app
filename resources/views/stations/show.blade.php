@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12">
            <section class="widget">
                <main class="widget-body">
                    @if (auth()->check())
                        <a href="{!! route('stations.edit', $station) !!}" class="btn btn-small btn-success right">Edit Station</a>
                    @endif
                    <h5>{{ $station->name }}</h5>
                    <p>Departures</p>
                    <table>
                        <thead>
                            <tr>
                                <th>To</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                <th>Duration</th>
                                <th>Train</th>
                                @if (auth()->check())
                                <th>Operator</th>
                                @endif
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ( ! $station->departureSchedules->isEmpty())
                                @foreach ($station->departureSchedules as $departure)
                                    <tr>
                                        <td>{{ $departure->arrivalStation->name }}</td>
                                        <td>{{ $departure->departureDateTime() }}</td>
                                        <td>{{ $departure->arrivalDateTime() }}</td>
                                        <td>{{ $departure->duration() }}</td>
                                        <td>{{ $departure->train->code }}</td>
                                        <td>{{ $departure->operator->name() }}</td>
                                        <td class="status-active">Active</td>
                                        <td>
                                            @if (auth()->check())
                                                <a href="{!! route('schedules.edit', $departure) !!}">Edit</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="center">No departures found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <br/><br/>
                    <p>Arrivals</p>
                    <table>
                        <thead>
                        <tr>
                            <th>From</th>
                            <th>Departure</th>
                            <th>Arrival</th>
                            <th>Duration</th>
                            <th>Train</th>
                            @if (auth()->check())
                                <th>Operator</th>
                            @endif
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ( ! $station->arrivalSchedules->isEmpty())
                            @foreach ($station->arrivalSchedules as $arrival)
                                <tr>
                                    <td>{{ $arrival->departureStation->name }}</td>
                                    <td>{{ $arrival->departureDateTime() }}</td>
                                    <td>{{ $arrival->arrivalDateTime() }}</td>
                                    <td>{{ $arrival->duration() }}</td>
                                    <td>{{ $arrival->train->code }}</td>
                                    <td>{{ $arrival->operator->name() }}</td>
                                    <td class="status-active">Active</td>
                                    <td>
                                        @if (auth()->check())
                                            <a href="{!! route('schedules.edit', $arrival) !!}">Edit</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="center">No arrivals found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </main>
            </section>
        </div>
    </section>
@endsection