@extends('layout.template')

@section('content')
    <section class="row" ng-controller="StationController">
        <div class="col s12 l6 offset-l3">
            <section class="widget">
                <main class="widget-body">
                    @include('../partials.messages')
                    <form action="{!! route('stations.store')!!} " method="POST" name="station" ng-submit="submit($event, 'create')" autocomplete="off">
                        {!! csrf_field() !!}
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" ng-model="form.name" 
                                                   name="name" 
                                                   ng-required="true" />
                                <label>Station Name</label>
                                <p class="field-text error" ng-show="station.name.$error.required && station.name.$touched">Station name is required</p>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <btn-submit class="right" ng-class="station.$invalid || loading ? 'disabled' : ''" 
                                                          ng-disabled="@{{ station.$invalid || loading }}" 
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