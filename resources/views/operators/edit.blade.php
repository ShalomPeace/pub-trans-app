@extends('layout.template')

@section('content')
    <section class="row" ng-controller="OperatorController">
        <div class="col s12 l6 offset-l3">
            <section class="widget" ng-init="operator = {{ $operator }}">
                <main class="widget-body">
                    @include('../partials.messages')
                    <form action="@{{ operator.route.update }}" method="POST" name="operatorForm" ng-submit="submit($event, 'update')" novalidate autocomplete="off">
                        {!! csrf_field() !!}
                        <input type="hidden" ng-model="form._method" name="_method" ng-init="form._method = 'PUT'" value="PUT"/>
                        <input type="hidden" ng-model="form.id" ng-init="form.id = operator.id">
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" ng-model="form.first_name" name="first_name" ng-init="form.first_name = operator.first_name" ng-required="true"/>
                                <label>First Name</label>
                                <p class="field-text error" ng-show="operatorForm.first_name.$error.required && operatorForm.first_name.$touched">First name is required</p>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" ng-model="form.last_name" name="last_name" ng-init="form.last_name = operator.last_name" ng-required="true"/>
                                <label>Last Name</label>
                                <p class="field-text error" ng-show="operatorForm.last_name.$error.required && operatorForm.last_name.$touched">Last name is required</p>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <btn-submit class="right" 
                                            ng-class="operatorForm.$invalid || loading ? 'disabled' : ''" 
                                            ng-disabled="operatorForm.$invalid || loading" 
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