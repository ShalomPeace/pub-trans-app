
@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12">
            <section class="widget">
                <main class="widget-body">
                    <a href="{!! route('trains.edit', $train) !!}" class="btn btn-small btn-info right">Edit Train</a>
                    <h5>{{ $train->code }} - {{ $train->name }}</h5>
                    <br/>
                    <p>Schedules</p>
                    <table>
                        <thead>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Departure</th>
                            <th>Arrival</th>
                            <th>Duration</th>
                            <th>Train</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ( ! $train->schedules->isEmpty())
                            @foreach ($train->schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->departureStation->name }}</td>
                                    <td>{{ $schedule->arrivalStation->name }}</td>
                                    <td>{{ $schedule->departureDateTime() }}</td>
                                    <td>{{ $schedule->arrivalDateTime() }}</td>
                                    <td>{{ $schedule->duration() }}</td>
                                    <td>{{ $schedule->train->code }}</td>
                                    <td class="status-active">Active</td>
                                    <td class="right-align">
                                        <a href="{{ route('schedules.show', $schedule) }}">View</a>
                                        <a href="{{ route('schedules.edit', $schedule) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="center">No schedules found.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </main>
            </section>
        </div>
    </section>
@endsection