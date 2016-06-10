@extends('layout.template')

@section('content')
    <section class="row" ng-controller="ScheduleController">
        <div class="col s12 l8 offset-l2">
            <section class="widget" ng-init="sched = {{ $schedule }}">
                <main class="widget-body">
                    <section class="row" ng-show="messages.get().length">
                        <div class="col s12">
                            <p ng-repeat="message in messages.get()" class="@{{ message.type }}-message center-align">@{{ message.message }}</p>
                        </div>
                    </section>
                    <form action="{!! route('schedules.update', $schedule) !!}" method="POST" name="schedule" ng-submit="update($event)" novalidate>
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT"/>
                        <input type="hidden" ng-model="form.id" ng-init="form.id = sched.id">
                        <section class="row">
                            <fieldset class="col s12 input-field" ng-init="departureStations = {{ $stations }}">
                                <material-select ng-model="form.departure_station_id" 
                                                 ng-init="form.departure_station_id = sched.departure_station_id"
                                                 name="departure_station_id" 
                                                 ng-options="station.id as station.name for station in departureStations" 
                                                 ng-required="true"  
                                                 ng-transclude>
                                    <option value="">-- Select Station --</option>
                                </material-select>
                                <label>Departure *</label>
                                <p class="field-text error" ng-show="schedule.departure_station_id.$invalid || schedule.departure_station_id.$touched">Departure station is required</p>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 m6 l6 input-field">
                                <input type="date" name="departure_date" 
                                                   min="@{{ getDateTime() | date:'yyyy-MM-dd' }}" 
                                                   ng-model="form.departure_date" 
                                                   ng-init="form.departure_date = getDateTime(sched.departure_date)" 
                                                   ng-change="form.arrival_date = form.departure_date" 
                                                   ng-required="true"/>
                                <label class="active">Date *</label>
                                <div ng-show="schedule.departure_date.$touched">
                                    <p class="field-text error" ng-show="schedule.departure_date.$error.required">Departure date is required</p>
                                    <p class="field-text error" ng-show="schedule.departure_date.$error.date || schedule.departure_date.$error.min">Invalid departure date</p>
                                </div>
                            </fieldset>
                            <fieldset class="col s12 m6 l6 input-field">
                                <input type="time" ng-model="form.departure_time" 
                                                   name="departure_time" 
                                                   ng-init="form.departure_time = getDateTime(sched.departure_date + ' ' +  sched.departure_time)" 
                                                   ng-required="true"/>
                                <label class="active">Time  *</label>
                                <div ng-show="schedule.departure_time.$invalid && schedule.departure_time.$touched">
                                    <p class="field-text error" ng-show="schedule.departure_time.$error.required">Departure time is required</p>
                                    <p class="field-text error" ng-show="schedule.departure_time.$error.time">Invalid departure time</p>
                                </div>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field" ng-init="arrivalStations = {{ $stations }}">
                                <material-select ng-model="form.arrival_station_id" 
                                                 ng-init="form.arrival_station_id = sched.arrival_station_id" 
                                                 name="arrival_station_id" 
                                                 ng-options="station.id as station.name for station in arrivalStations" 
                                                 ng-required="true" 
                                                 ng-transclude>
                                    <option value="" selected>-- Select Station --</option>
                                </material-select>
                                <label>Arrival</label>
                                <p class="field-text error" ng-show="schedule.arrival_station_id.$error.required">Arrival station is required</p>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s6 input-field">
                                <input type="date" name="arrival_date" 
                                                   min="@{{ form.departure_date | date:'yyyy-MM-dd' }}" 
                                                   ng-model="form.arrival_date" 
                                                   ng-init="form.arrival_date = getDateTime(sched.arrival_date)" 
                                                   ng-required="true"/>
                                <label for="" class="active">Date *</label>
                                <div ng-show="schedule.arrival_date.$touched">
                                    <p class="field-text error" ng-show="schedule.arrival_date.$error.required">Arrival date is required</p>
                                    <p class="field-text error" ng-show="schedule.arrival_date.$error.date || schedule.arrival_date.$error.min">Invalid arrival date</p>
                                </div>
                            </fieldset>
                            <fieldset class="col s6 input-field">
                                <input type="time" ng-model="form.arrival_time" 
                                                   name="arrival_time" 
                                                   ng-init="form.arrival_time = getDateTime(sched.arrival_date + ' ' + sched.arrival_time)"
                                                   ng-required="true"/>
                                <label for="" class="active">Time *</label>
                                <div ng-show="schedule.arrival_time.$touched">
                                    <p class="field-text error" ng-show="schedule.arrival_time.$error.required">Arrival time is required</p>
                                    <p class="field-text error" ng-show="schedule.arrival_time.$error.time">Invalid arrival date</p>
                                </div>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 l6 input-field" ng-init="trains = {{ $trains }}">
                                <material-select name="train_id" 
                                                 ng-model="form.train_id" 
                                                 ng-init="form.train_id = sched.train_id" 
                                                 ng-options="train.id as train.name for train in trains" 
                                                 ng-required="true" 
                                                 ng-transclude>
                                    <option value="" selected>-- Select Train --</option>
                                </material-select>
                                <label>Train *</label>
                                <p class="field-text error" ng-show="schedule.train_id.$error.required">Train is required</p>
                            </fieldset>
                            <fieldset class="col s12 l6 input-field" ng-init="operators = {{ $operators }}">
                                <material-select name="operator_id" 
                                                 ng-model="form.operator_id" 
                                                 ng-init="form.operator_id = sched.operator_id"
                                                 ng-options="operator.id as (operator.first_name + ' ' + operator.last_name) for operator in operators" 
                                                 ng-required="true" 
                                                 ng-transclude>
                                    <option value="" selected>-- Select Operator --</option>
                                </material-select>
                                <label>Operator *</label>
                                <p class="field-text error" ng-show="schedule.operator_id.$error.required">Operator is required</p>
                            </fieldset>
                        </section>
                        <div class="row">
                            <fieldset class="col s12 input-field">
                                <material-select ng-model="form.status" 
                                                 name="status" 
                                                 ng-init="form.status = sched.status" 
                                                 ng-options="status for status in ['Active', 'Departed', 'Arrived', 'Delayed', 'Cancelled'] track by status" 
                                                 ng-required="true" 
                                                 ng-transclude>
                                    <option value="" selected>-- Select Status</option>
                                </material-select>
                            </fieldset>
                        </div>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <btn-submit class="right@{{ schedule.$invalid || loading ? ' disabled' : '' }}" 
                                            ng-disabled="schedule.$invalid || loading" 
                                            ng-transclude>
                                    Save
                                </btn-submit>
                            </fieldset>
                        </section>
                    </form>
                </main>
            </section>
        </div>
    </section>
@endsection