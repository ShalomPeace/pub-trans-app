@extends('layout.template')

@section('content')
    <section class="row" ng-controller="OperatorController">
        <div class="col s12 l8 offset-l2">
            <section class="widget" ng-init="operators = {{ $operators }}">
                <main class="widget-body">
                    <section class="row">
                        <div class="col s12">
                            <btn-link href="{!! route('operators.create') !!}" 
                                      class="btn-small right" 
                                      ng-if="{{ auth()->check() }}">
                                Add Operator
                            </btn-link>
                        </div>
                    </section>
                    <section class="row">
                        <div class="col s12">
                            <table class="responsive-table">
                                <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th ng-if="{{ auth()->check() }}">Date Added</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr ng-if="operators.length" ng-repeat="operator in operators">
                                        <td>@{{ operator.first_name }}</td>
                                        <td>@{{ operator.last_name }}</td>
                                        <td ng-if="{{ auth()->check() }}">@{{ operator.created_at }}</td>
                                        <td class="right-align">
                                            <a href="@{{ operator.route.show }}">View</a>
                                            <a href="@{{ operator.route.edit }}" ng-if="{{ auth()->check() }}">Edit</a>
                                        </td>
                                    </tr>
                                    <tr ng-if=" ! operators.length">
                                        <td colspan="{{ auth()->check() ? 4 : 3 }}" align="center">No operators found.</td>
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