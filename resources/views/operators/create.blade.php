@extends('layout.template')

@section('content')
    <section class="row" ng-controller="OperatorController">
        <div class="col s12 l6 offset-l3">
            <section class="widget">
                <main class="widget-body">
                    @include('../partials.messages')
                    <form action="{!! route('operators.store') !!}" method="POST" name="operator" ng-submit="submit($event, 'create')" novalidate autocomplete="off">
                        {!! csrf_field() !!}
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" ng-model="form.first_name" name="first_name" ng-required="true"/>
                                <label>First Name</label>
                                <p class="field-text error" ng-show="operator.first_name.$error.required && operator.first_name.$touched">First name is required</p>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" ng-model="form.last_name" name="last_name" ng-required="true"/>
                                <label>Last Name</label>
                                <p class="field-text error" ng-show="operator.last_name.$error.required && operator.last_name.$touched">Last name is required</p>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <btn-submit class="right" 
                                            ng-class="operator.$invalid || loading ? 'disabled' : ''" 
                                            ng-disabled="operator.$invalid || loading" 
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