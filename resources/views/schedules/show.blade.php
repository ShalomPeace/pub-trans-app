@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 m12 l8 offset-l2">
            <section class="widget">
                <main class="widget-body">
                    <article class="schedule" ng-init="schedule = {{ $schedule }}">
                        <aside class="right">
                            <button type="button" class="btn btn-small btn-success">Active</button>
                        </aside>
                        <p class="stations">@{{ schedule.departure.station.name }} - @{{ schedule.arrival.station.name }}</p>
                        <p><strong>Departure:</strong> @{{ schedule.departure.formatted_date_time }}</p>
                        <p><strong>Arrival:</strong> @{{ schedule.arrival.formatted_date_time }}</p>
                        <p><strong>Duration:</strong> @{{ schedule.duration }}</p>
                        <p><strong>Train:</strong> @{{ schedule.train.name }}</p>
                        <p><strong>Train Operator:</strong> @{{ schedule.operator.first_name }} @{{ schedule.operator.last_name }}</p>
                        <br>
                        @if (auth()->user())
                        <a href="schedules/@{{ schedule.id }}/edit" class="btn btn-small btn-info">Edit Schedule</a>
                        @endif
                    </article>
                </main>
            </section>
        </div>
    </section>


@endsection