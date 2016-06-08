@extends('layout.template')

@section('content')
    <section class="row" ng-controller="ScheduleController">
        <div class="col s12 l8 offset-l2">
            <section class="widget">
                <main class="widget-body">
                    <form action="{!! route('schedules.store') !!}" method="POST">
                        {!! csrf_field() !!}
                        <section class="row">
                            <fieldset class="col s12" ng-init="departureStations = {{ $stations }}">
                                <material-select ng-model="form.departure_station_id"
                                                 ng-init="form.departure_station_id = 0" 
                                                 name="departure_station_id" 
                                                 ng-options="station.id as station.name for station in departureStations track by station.id" 
                                                 ng-transclude>
                                    <option value="">-- Departure Station --</option>
                                </material-select>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 m6 l6 input-field">
                                <input type="date" name="departure_date" 
                                                   min="@{{ getCurrentDate() | date:'yyyy-MM-dd' }}" 
                                                   ng-model="form.departure_date" 
                                                   ng-init="form.departure_date = getCurrentDate() | date:'yyyy-MM-dd'"/>
                                <label for="" class="active">Date</label>
                            </fieldset>
                            <fieldset class="col s12 m6 l6 input-field">
                                <input type="time" name="departure_time" ng-model="form.departure_time"/>
                                <label for="" class="active">Time</label>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12" ng-init="arrivalStations = {{ $stations }}">
                                <material-select ng-model="form.arrival_station_id" 
                                                 name="arrival_station_id" 
                                                 ng-options="station.id as station.name for station in arrivalStations track by station.id" 
                                                 ng-transclude>
                                    <option value="" selected>-- Arrival Station --</option>
                                </material-select>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s6 input-field">
                                <input type="date" name="arrival_date" min="@{{ form.departure_date | date:'yyyy-MM-dd' }}" ng-model="form.arrival_date"/>
                                <label for="" class="active">Date</label>
                            </fieldset>
                            <fieldset class="col s6 input-field">
                                <input type="time" name="arrival_time" ng-model="form.arrival_time"/>
                                <label for="" class="active">Time</label>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 l6 input-field" ng-init="trains = {{ $trains }}">
                                <material-select name="train_id" 
                                                 ng-model="form.train_id" 
                                                 ng-options="train.id as train.name for train in trains track by train.id" 
                                                 ng-transclude>
                                    <option value="" selected>-- Select Train --</option>
                                </material-select>
                                <label for="">Train</label>
                            </fieldset>
                            <fieldset class="col s12 l6 input-field" ng-init="operators = {{ $operators }}">
                                <material-select name="operator_id" 
                                                 ng-model="form.operator_id" 
                                                 ng-options="operator.id as (operator.first_name + ' ' + operator.last_name) for operator in operators track by operator.id" 
                                                 ng-transclude>
                                    <option value="" selected>-- Select Operator --</option>
                                </material-select>
                                <label for="">Operator</label>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <button class="btn btn-small btn-success right">
                                    Add
                                </button>
                            </fieldset>
                        </section>
                    </form>
                </main>
            </section>
        </div>
    </section>
@endsection