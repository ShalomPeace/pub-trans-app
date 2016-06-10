@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 m12 l8 offset-l2">
            <section class="widget">
                <main class="widget-body">
                    <article class="schedule" ng-init="schedule = {{ $schedule }}">
                        <aside class="right">
                            <button type="button" class="btn btn-small btn-success status-@{{ schedule.status.toLowerCase() }}">@{{ schedule.status }}</button>
                        </aside>
                        <p class="stations">@{{ schedule.departure.station.name }} - @{{ schedule.arrival.station.name }}</p>
                        <p><strong>Departure:</strong> @{{ schedule.departure.formatted_date_time }}</p>
                        <p><strong>Arrival:</strong> @{{ schedule.arrival.formatted_date_time }}</p>
                        <p><strong>Duration:</strong> @{{ schedule.duration }}</p>
                        <p><strong>Train:</strong> @{{ schedule.train.name }}</p>
                        <p><strong>Operator:</strong> @{{ schedule.operator.first_name }} @{{ schedule.operator.last_name }}</p>
                        <br>
                        <a href="schedules/@{{ schedule.id }}/edit" ng-if="{{ auth()->check() }}" class="btn btn-small btn-info">Edit Schedule</a>
                    </article>
                </main>
            </section>
        </div>
    </section>


@endsection