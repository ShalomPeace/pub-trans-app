@extends('layout.template')

@section('content')
    <section class="row" ng-controller="OperatorController">
        <div class="col s12">
            <section class="row">
                <div class="col s12">
                    <btn-link href="@{{ operator.route.edit }}" 
                              class="btn-small right" 
                              ng-if="{{ auth()->check() }}">
                        Edit Operator
                    </btn-link>
                </div>
            </section>
            <section class="widget" ng-init="operator = {{ $operator }}">
                <main class="widget-body">
                    <h5>@{{ operator.full_name }}</h5>
                    <section class="row">
                        <div class="col s12">
                            <p>Schedules</p>
                            <table class="responsive-table">
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
                                    <tr ng-if="operator.schedules.length" ng-repeat="schedule in operator.schedules">
                                        <td>@{{ schedule.departure_station.name }}</td>
                                        <td>@{{ schedule.arrival_station.name }}</td>
                                        <td>@{{ schedule.departure_date_time }}</td>
                                        <td>@{{ schedule.arrival_date_time }}</td>
                                        <td>@{{ schedule.duration }}</td>
                                        <td>@{{ schedule.train.code }}</td>
                                        <td class="status-text-@{{ schedule.status.toLowerCase() }}">@{{ schedule.status }}</td>
                                        <td class="right-align">
                                            <a href="@{{ schedule.route.show }}">View</a>
                                            <a href="@{{ schedule.route.edit }}">Edit</a>
                                        </td>
                                    </tr>
                                    <tr ng-if=" ! operator.schedules.length">
                                        <td colspan="8" class="center">No schedules found.</td>
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