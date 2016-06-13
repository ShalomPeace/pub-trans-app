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
                        <p class="stations">@{{ schedule.departure_station.name }} - @{{ schedule.arrival_station.name }}</p>
                        <p><strong>Departure:</strong> @{{ schedule.departure_date_time }}</p>
                        <p><strong>Arrival:</strong> @{{ schedule.arrival_date_time }}</p>
                        <p><strong>Duration:</strong> @{{ schedule.duration }}</p>
                        <p><strong>Train:</strong> @{{ schedule.train.name }}</p>
                        <p><strong>Operator:</strong> @{{ schedule.operator.full_name }}</p>
                        <br>
                        <btn-link href="@{{ schedule.route.edit }}" ng-if="{{ auth()->check() }}" class="btn-small" ng-transclude>Edit Schedule</btn-link>
                    </article>
                </main>
            </section>
        </div>
    </section>


@endsection