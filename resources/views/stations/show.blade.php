@extends('layout.template')

@section('content')
    <section class="row" ng-controller="StationController">
        <div class="col s12">
            <section class="row">
                <div class="col s12">
                    <btn-link href="@{{ station.route.edit }}" class="btn-small right" ng-if="{{ auth()->check() }}">Edit Station</btn-link>
                </div>
            </section>
            <section class="widget" ng-init="station = {{ $station }}">
                <main class="widget-body">
                    <h5>@{{ station.name }}</h5>
                    <section class="row">
                        <div class="col s12">
                            <p>Departures</p>
                            <table class="responsive-table">
                                <thead>
                                    <tr>
                                        <th>To</th>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>Duration</th>
                                        <th>Train</th>
                                        <th ng-if="{{ auth()->check() }}">Operator</th>
                                        <th>Status</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-if="station.departure_schedules.length" ng-repeat="departure in station.departure_schedules">
                                        <td>@{{ departure.arrival_station.name }}</td>
                                        <td>@{{ departure.departure_date_time }}</td>
                                        <td>@{{ departure.arrival_date_time }}</td>
                                        <td>@{{ departure.duration }}</td>
                                        <td>@{{ departure.train.name }}</td>
                                        <td>@{{ departure.operator.full_name }}</td>
                                        <td class="status-text-@{{ departure.status.toLowerCase() }}">@{{ departure.status }}</td>
                                        <td>
                                            <a href="@{{ departure.route.show }}">View</a>
                                            <a href="@{{ departure.route.edit }}" ng-if="{{ auth()->check() }}">Edit</a>
                                        </td>
                                    </tr>
                                    <tr ng-if=" ! station.departure_schedules.length">
                                        <td class="center" colspan="{{ auth()->check() ? 8 : 7 }}">No schedules found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <section class="row">
                        <div class="col s12">
                            <p>Arrivals</p>
                            <table class="responsive-table">
                                <thead>
                                <tr>
                                    <th>From</th>
                                    <th>Departure</th>
                                    <th>Arrival</th>
                                    <th>Duration</th>
                                    <th>Train</th>
                                    <th ng-if="{{ auth()->check() }}">Operator</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr ng-if="station.arrival_schedules.length" ng-repeat="departure in station.arrival_schedules">
                                        <td>@{{ departure.arrival_station.name }}</td>
                                        <td>@{{ departure.departure_date_time }}</td>
                                        <td>@{{ departure.arrival_date_time }}</td>
                                        <td>@{{ departure.duration }}</td>
                                        <td>@{{ departure.train.name }}</td>
                                        <td>@{{ departure.operator.full_name }}</td>
                                        <td class="status-text-@{{ departure.status.toLowerCase() }}">@{{ departure.status }}</td>
                                        <td>
                                            <a href="@{{ departure.route.show }}">View</a>
                                            <a href="@{{ departure.route.edit }}" ng-if="{{ auth()->check() }}">Edit</a>
                                        </td>
                                    </tr>
                                    <tr ng-if=" ! station.arrival_schedules.length">
                                        <td class="center" colspan="{{ auth()->check() ? 8 : 7 }}">No schedules found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </main>
            </section>
        </div>
    </section>
@endsection