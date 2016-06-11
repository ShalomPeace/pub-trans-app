@extends('layout.template')

@section('content')
    <section class="row" ng-controller="TrainController">
        <div class="col s12 l8 offset-l2">
            <section class="widget" ng-init="trains = {{ $trains }}">
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
                                <th ng-if="{{ auth()->check() }}">Date Added</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-if="trains.length" ng-repeat="train in trains">
                                <td>@{{ train.code }}</td>
                                <td>@{{ train.name }}</td>
                                <td>@{{ train.total_seats_text }}</td>
                                <td ng-if="{{ auth()->check() }}">@{{ train.created_at }}</td>
                                <td class="right-align">
                                    <a href="@{{ train.route.show }}">View</a>
                                    <a href="@{{ train.route.edit }}" ng-if="{{ auth()->check() }}">Edit</a>
                                </td>
                            </tr>
                            <tr ng-if=" ! trains.length">
                                <td class="center" colspan="{{ auth()->check() ? 5 : 4 }}">No trains found.</td>
                            </tr>
                        </tbody>
                    </table>
                </main>
            </section>
        </div>
    </section>
@endsection