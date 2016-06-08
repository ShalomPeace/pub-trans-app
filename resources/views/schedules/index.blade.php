@extends('layout.template')

@section('content')
    <section class="row" ng-controller="ScheduleController">
        <div class="col s12">
            <section class="widget">
                <main class="widget-body">
                    <section class="row">
                        <div class="col s12">
                            Search Schedules
                        </div>
                    </section>
                    <section class="row" ng-init="stations = {{ $stations }}">
                        <div class="col s9">
                            <form action="{!! route('schedules.search') !!}" method="GET" ng-submit="search($event)">
                                <section class="row">
                                    <fieldset class="col s4 input-field" ng-init="departureStations = stations">
                                        <material-select name="departure" 
                                                         ng-model="form.departure" 
                                                         ng-options="station.id as station.name for station in departureStations track by station.id" 
                                                         ng-init="form.departure = {{ $departure or 0 }}" 
                                                         ng-transclude>
                                            <option value="">-- Departure --</option>
                                        </material-select>
                                    </fieldset>
                                    <fieldset class="col s4 input-field" ng-init="arrivalStations = stations">
                                        <material-select name="arrival" 
                                                         ng-model="form.arrival" 
                                                         ng-options="station.id as station.name for station in arrivalStations track by station.id" 
                                                         ng-init="form.arrival = {{ $arrival or 0 }}" 
                                                         ng-transclude>
                                            <option value="" selected>-- Arrival --</option>
                                        </material-select>
                                    </fieldset>
                                    <fieldset class="col s4 input-field">
                                        <btn-submit ng-transclude ng-class="canSearch()">
                                            Search
                                        </btn-submit>
                                    </fieldset>
                                </section>
                            </form>
                        </div>
                        <div class="col s3">
                           @if (auth()->check())
                                <btn-link href="{!! route('schedules.create') !!}" class="right">Add Schedule</btn-link>
                           @endif
                        </div>
                    </section>
                    <section class="row">
                        <div class="col s12">
                            <section ng-show="loader" class="center">
                                <preloader-circle></preloader-circle>
                            </section>
                            <section ng-init="schedules = {{ $schedules}}" ng-show="schedules.length && ! loader">
                                <article class="schedules" ng-repeat="schedule in schedules">
                                    <aside class="right">
                                        <a href="schedules/@{{ schedule.id }} " class="btn btn-small btn-info">View</a>
                                        @if (auth()->check())
                                            <a href="schedules/@{{ schedule.id }}/edit" class="btn btn-small btn-success">Edit</a>
                                        @endif
                                    </aside>
                                    <p class="stations">@{{ schedule.departure.station.name }} - @{{ schedule.arrival.station.name }}</p>
                                    <p><strong>Departure:</strong> <date>@{{ schedule.departure.formatted_date_time }}</date></p>
                                    <p><strong>Arrival:</strong> <date>@{{ schedule.arrival.formatted_date_time }}</date></p>
                                    <p><stron>Duration:</stron> @{{ schedule.duration }}</p>
                                    <p><strong>Train Number:</strong> @{{ schedule.train.name }}</p>
                                    <p><strong>Status:</strong> <span class="status-@{{ schedule.status || 'active' }}">@{{ schedule.status || 'Active' }}</span></p>
                                </article>
                            </section>
                            <section ng-show="! schedules.length && ! loader" class="center">
                                <p>No schedules found.</p>
                            </section>
                        </div>
                    </section>
                </main>
            </section>
        </div>
    </section>
@endsection