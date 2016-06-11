@extends('layout.template')

@section('content')
    <section class="row" ng-controller="StationController">
        <div class="col s12 l6 offset-l3">
            <section class="widget">
                <main class="widget-body">
                    @include('../partials.messages')
                    <form action="{!! route('stations.update', $station)!!} " method="POST" name="station" ng-submit="submit($event, 'update')" autocomplete="off">
                        {!! csrf_field() !!}
                        <input type="hidden" ng-model="form._method" 
                                             name="_method" 
                                             ng-init="form._method = 'PUT'" 
                                             value="PUT"/>
                        <input type="hidden" ng-init="form.id = {{ $station->id }}">
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" ng-model="form.name" 
                                                   ng-init="form.name = '{{ $station->name }}'" 
                                                   name="name"/>
                                <label>Station Name</label>
                                <p class="field-text error" ng-show="station.name.$error.required && station.name.$touched">Station name is required</p>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <btn-submit class="right" ng-class="station.$invalid || loading ? 'disabled' : ''" 
                                                          ng-disabled="@{{ station.$invalid || loading }}" 
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