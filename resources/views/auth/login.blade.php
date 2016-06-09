@extends('layout.template')

@section('content')
    <section class="row" ng-controller="AuthController">
        <div class="col s12 m8 l6 offset-l3 offset-m4">
            <section class="widget">
                <main class="widget-body">
                    <section class="row row-no-mb">
                        <div class="col s12 m12 l10 offset-l1">
                            <section class="row">
                                <div class="col s12">
                                    <p ng-repeat="message in messages" class="@{{ message.type }}-message center-align">@{{ message.message }}</p>
                                </div>
                            </section>
                            <form action="{!! route('login.attempt') !!}" method="POST" ng-submit="login($event)" name="loginForm">
                                {!! csrf_field() !!}
                                <section class="row">
                                    <fieldset class="col s12 input-field">
                                        <input type="text" ng-model="form.username" name="username" ng-required="true">
                                        <label>Username</label>
                                        <p ng-show="loginForm.username.$invalid && loginForm.username.$touched" class="field-text error">Username is required</p>
                                    </fieldset>
                                </section>
                                <section class="row">
                                    <fieldset class="col s12 input-field">
                                        <input type="password" ng-model="form.password" name="password" ng-required="true">
                                        <label>Password</label>
                                        <p ng-show="loginForm.password.$invalid && loginForm.password.$touched" class="field-text error">Password is required</p>
                                    </fieldset>
                                </section>
                                <section class="row row-no-mb">
                                    <fieldset class="col s12 input-field center">
                                        <btn-submit ng-class="loginForm.$invalid || loading ? ' disabled' : ''"
                                                    ng-disabled="loginForm.$invalid || loading" 
                                                    ng-transclude>
                                            Login
                                        </btn-submit>
                                    </fieldset>
                                </section>
                            </form>
                        </div>
                    </section>
                </main>
            </section>
        </div>
    </section>
@endsection