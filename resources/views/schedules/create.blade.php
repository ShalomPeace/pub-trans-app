@extends('layout.template')

@section('content')
    <section class="row" ng-controller="ScheduleController">
        <div class="col s12 l8 offset-l2">
            <section class="widget">
                <main class="widget-body">
                    @include('../partials/messages')
                    <form action="{!! route('schedules.store') !!}" method="POST" name="schedule" ng-submit="submit($event, 'create')" novalidate autocomplete="off">
                        {!! csrf_field() !!}
                        <input type="hidden" ng-model="form.status" ng-init="form.status = 'Active'">
                        <section class="row">
                            <fieldset class="col s12 input-field" ng-init="departureStations = {{ $stations }}">
                                <material-select ng-model="form.departure_station_id"
                                                 ng-init="form.departure_station_id = 0" 
                                                 name="departure_station_id" 
                                                 ng-options="station.id as station.name for station in departureStations track by station.id" 
                                                 ng-required="true"  
                                                 ng-transclude>
                                    <option value="">-- Select Station --</option>
                                </material-select>
                                <label>Departure *</label>
                                <p class="field-text error" ng-show="schedule.departure_station_id.$invalid || schedule.departure_station_id.$touched">Departure station is required</p>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 m6 l6 input-field">
                                <section class="row row-expand">
                                    <div class="col s12">
                                        <input type="date" name="departure_date" 
                                                           min="@{{ getDateTime() | date:'yyyy-MM-dd' }}" 
                                                           ng-model="form.departure_date" 
                                                           ng-init="form.departure_date = getDateTime()" 
                                                           ng-change="form.arrival_date = form.departure_date" 
                                                           ng-required="true"/>
                                        <label class="active">Date *</label>
                                        <div ng-show="schedule.departure_date.$touched">
                                            <p class="field-text error" ng-show="schedule.departure_date.$error.required">Departure date is required</p>
                                            <p class="field-text error" ng-show="schedule.departure_date.$error.date || schedule.departure_date.$error.min">Invalid departure date</p>
                                        </div>
                                    </div>
                                </section>
                            </fieldset>
                            <fieldset class="col s12 m6 l6 input-field">
                                <section class="row row-expand">
                                    <div class="col s12">
                                        <input type="time" name="departure_time" ng-model="form.departure_time" ng-required="true"/>
                                        <label class="active">Time  *</label>
                                        <div ng-show="schedule.departure_time.$invalid && schedule.departure_time.$touched">
                                            <p class="field-text error" ng-show="schedule.departure_time.$error.required">Departure time is required</p>
                                            <p class="field-text error" ng-show="schedule.departure_time.$error.time">Invalid departure time</p>
                                        </div>
                                    </div>
                                </section>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field" ng-init="arrivalStations = {{ $stations }}">
                                <material-select ng-model="form.arrival_station_id" 
                                                 ng-init="form.arrival_station_id = 0" 
                                                 name="arrival_station_id" 
                                                 ng-options="station.id as station.name for station in arrivalStations track by station.id" 
                                                 ng-required="true" 
                                                 ng-transclude>
                                    <option value="" selected>-- Select Station --</option>
                                </material-select>
                                <label>Arrival</label>
                                <p class="field-text error" ng-show="schedule.arrival_station_id.$error.required">Arrival station is required</p>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 l6 input-field">
                                <section class="row row-expand">
                                    <div class="col s12">
                                        <input type="date" name="arrival_date" 
                                                           min="@{{ form.departure_date | date:'yyyy-MM-dd' }}" 
                                                           ng-model="form.arrival_date" 
                                                           ng-init="form.arrival_date = form.departure_date" 
                                                           ng-required="true"/>
                                        <label for="" class="active">Date *</label>
                                        <div ng-show="schedule.arrival_date.$touched">
                                            <p class="field-text error" ng-show="schedule.arrival_date.$error.required">Arrival date is required</p>
                                            <p class="field-text error" ng-show="schedule.arrival_date.$error.date || schedule.arrival_date.$error.min">Invalid arrival date</p>
                                        </div>
                                    </div>
                                </section>
                            </fieldset>
                            <fieldset class="col s12 l6 input-field">
                                <section class="row">
                                    <div class="col s12">
                                        <input type="time" name="arrival_time" ng-model="form.arrival_time" ng-required="true"/>
                                        <label for="" class="active">Time *</label>
                                        <div ng-show="schedule.arrival_time.$touched">
                                            <p class="field-text error" ng-show="schedule.arrival_time.$error.required">Arrival time is required</p>
                                            <p class="field-text error" ng-show="schedule.arrival_time.$error.time">Invalid arrival date</p>
                                        </div>
                                    </div>
                                </section>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 l6 input-field" ng-init="trains = {{ $trains }}">
                                <section class="row">
                                    <div class="col s12">
                                        <material-select name="train_id" 
                                                         ng-model="form.train_id" 
                                                         ng-init="form.train_id = 0" 
                                                         ng-options="train.id as train.name for train in trains track by train.id" 
                                                         ng-required="true" 
                                                         ng-transclude>
                                            <option value="" selected>-- Select Train --</option>
                                        </material-select>
                                        <label>Train *</label>
                                        <p class="field-text error" ng-show="schedule.train_id.$error.required">Train is required</p>
                                    </div>
                                </section>
                            </fieldset>
                            <fieldset class="col s12 l6 input-field" ng-init="operators = {{ $operators }}">
                                <section class="row">
                                    <div class="col s12">
                                        <material-select name="operator_id" 
                                                         ng-model="form.operator_id" 
                                                         ng-init="form.operator_id = 0"
                                                         ng-options="operator.id as (operator.first_name + ' ' + operator.last_name) for operator in operators track by operator.id" 
                                                         ng-required="true" 
                                                         ng-transclude>
                                            <option value="" selected>-- Select Operator --</option>
                                        </material-select>
                                        <label>Operator *</label>
                                        <p class="field-text error" ng-show="schedule.operator_id.$error.required">Operator is required</p>
                                    </div>
                                </section>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <btn-submit class="right@{{ schedule.$invalid || loading ? ' disabled' : '' }}" 
                                            ng-disabled="schedule.$invalid || loading" 
                                            ng-transclude>
                                    Add
                                </btn-submit>
                            </fieldset>
                        </section>
                    </form>
                </main>
            </section>
        </div>
    </section>
@endsection