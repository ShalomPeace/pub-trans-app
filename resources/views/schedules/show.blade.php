@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 m12 l8 offset-l2">
            <section class="widget">
                <main class="widget-body">
                    <article class="schedule">
                        <aside class="right">
                            <button type="button" class="btn btn-small btn-success">Active</button>
                        </aside>
                        <p class="stations">{{ $schedule->departureStation->name }} - {{ $schedule->arrivalStation->name }}</p>
                        <p><strong>Departure:</strong> {{ $schedule->departureDateTime() }}</p>
                        <p><strong>Arrival:</strong> {{ $schedule->arrivalDateTime() }}</p>
                        <p><strong>Duration:</strong> {{ $schedule->duration() }}</p>
                        <p><strong>Train: </strong> {{ $schedule->train->code }} - {{ $schedule->train->name }}</p>
                        <p><strong>Train Operator: </strong> {{ $schedule->operator->name() }}</p>
                        <br>
                        @if (auth()->user())
                        <a href="{!! route('schedules.edit', $schedule) !!}" class="btn btn-small btn-info">Edit Schedule</a>
                        @endif
                    </article>
                </main>
            </section>
        </div>
    </section>


@endsection