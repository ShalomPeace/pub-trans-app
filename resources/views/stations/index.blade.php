@extends('layout.template')

@section('content')
    <div ng-controller="StationController">
        <section class="row" ng-if="{{ auth()->check() }}">
            <div class="col s12">
                <a href="{!! route('stations.create') !!}" class="btn btn-small btn-info right">Add Station</a>
            </div>
        </section>
        <section class="row" ng-init="chunkStations = {{ $stations->chunk(3) }}">
            <div class="col s12">
                <div class="row row-no-mb" ng-repeat="stations in chunkStations">
                    <div class="col s12 m6 l4" ng-repeat="station in stations">
                        <section class="row row-no-mb">
                            <div class="col s12">
                               <div class="card">
                                   <div class="card-content">
                                       <span class="card-title">@{{ station.name }}</span>
                                       <p>@{{ station.total_schedule }} Schedule(s)</p>
                                       <br>
                                       <p><strong>Departure:</strong> @{{ station.departure_schedules.length }}</p>
                                       <p><strong>Arrival:</strong> @{{ station.arrival_schedules.length }}</p>
                                   </div>
                                   <div class="card-action">
                                       <a href="@{{ station.route.show }}">View</a>
                                       @if (auth()->check())
                                       <a href="@{{ station.route.edit }}">Edit</a>
                                       @endif
                                   </div>
                               </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection