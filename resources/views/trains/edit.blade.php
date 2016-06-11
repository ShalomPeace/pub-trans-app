@extends('layout.template')

@section('content')
    <section class="row" ng-controller="TrainController">
        <div class="col s12 l6 offset-l3">
            <section class="widget" ng-init="train = {{ $train }}">
                <main class="widget-body">
                    @include('../partials.messages');
                    <form action="@{{ train.route.update }}" method="POST" name="trainForm" ng-submit="submit($event, 'update')" novalidate autocomplete="off">
                        {!! csrf_field() !!}
                        <input type="hidden" ng-model="form._method" 
                                             name="_method" 
                                             ng-init="form._method = 'PUT'" 
                                             value="PUT"/>
                        <input type="hidden" ng-model="form.id" ng-init="form.id = train.id"/>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" ng-model="form.code" 
                                                   ng-init="form.code = train.code" 
                                                   name="code" 
                                                   disabled/>
                                <label class="active">Code</label>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" ng-model="form.name" name="name" ng-init="form.name = train.name" ng-required="true"/>
                                <label class="active">Name</label>
                                <p class="field-text error" ng-show="trainForm.name.$error.required && trainForm.name.$touched">Name is required</p>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="number" ng-model="form.total_seats" name="total_seats" ng-init="form.total_seats = train.total_seats" ng-required="true"/>
                                <label class="active">Total Seats</label>
                                <p class="field-text error" ng-show="trainForm.total_seats.$error.required && trainForm.total_seats.$touched">Total seats is required.</p>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <btn-submit class="right" 
                                        ng-class="trainForm.$invalid || loading ? 'disabled' : ''" 
                                        ng-disabled="trainForm.$invalid || loading" 
                                        ng-transclude>
                                Save
                            </btn-submit>
                        </section>
                    </form>
                </main>
            </section>
        </div>
    </section>
@endsection