@extends('layout.template')

@section('content')
    <section class="row" ng-controller="TrainController">
        <div class="col s12 l6 offset-l3">
            <section class="widget">
                <main class="widget-body">
                    @include('../partials.messages')
                    <form action="{!! route('trains.store') !!}" method="POST" name="train" ng-submit="submit($event, 'create')" novalidate autocomplete="off">
                        {!! csrf_field() !!}
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" ng-model="form.code" 
                                                   name="code" 
                                                   ng-init="form.code = '{{ $code }}'" 
                                                   value="{{ $code }}" 
                                                   disabled/>
                                <label class="active">Code</label>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" ng-model="form.name" 
                                                   name="name" 
                                                   ng-required="true"/>
                                <label>Name</label>
                                <p class="field-text error" ng-show="train.name.$error.required && train.name.$touched">Name is required</p>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="number" ng-model="form.total_seats" 
                                                     name="total_seats" 
                                                     ng-required="true"/>
                                <label>Total Seats</label>
                                <p class="field-text error" ng-show="train.total_seats.$error.required && train.total_seats.$touched">Total seats is required.</p>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <btn-submit class="right" 
                                            ng-class="train.$invalid || loading ? 'disabled' : ''" 
                                            ng-disabled="train.$invalid || loading" 
                                            ng-transclude>
                                    Add Train
                                </btn-submit>
                            </fieldset>
                        </section>
                    </form>
                </main>
            </section>
        </div>
    </section>
@endsection