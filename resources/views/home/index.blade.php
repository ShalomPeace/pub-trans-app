@extends('layout.template')

@section('content')
    <div ng-controller="HomeController">
        <section class="row row-expand">
            <div class="col s8 offset-s2" style="margin-top: 150px;">
                <form action="{!! route('schedules.search') !!}" method="GET">
                    <section class="row row-expand" ng-init="stations = {{ $stations }}">
                        <fieldset class="col s12 m6 l6 input-field select-dropdown-box" ng-init="departureStations = stations">
                            <material-select ng-model="form.departure"
                                             name="departure"
                                             ng-options="station.id as station.name for station in departureStations track by station.id"
                                             ng-transclude>
                                <option value="" selected>-- Departure --</option>
                            </material-select>
                        </fieldset>
                        <fieldset class="col s12 m6 l6 right input-field select-dropdown-box" ng-init="arrivalStations = stations">
                            <material-select ng-model="form.arrival" 
                                             name="arrival" 
                                             ng-options="station.id as station.name for station in arrivalStations track by station.id" 
                                             ng-transclude>
                                <option value="" selected>-- Arrival --</option>
                            </material-select>
                        </fieldset>
                    </section>
                    <section class="row">
                        <fieldset class="col s12 center">
                            <button type="submit" class="btn btn-success">Search Schedules</button>
                        </fieldset>
                    </section>
                </form>
            </div>
        </section>
    </div>
@endsection