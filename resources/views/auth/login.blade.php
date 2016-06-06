@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 m8 l6 offset-l3 offset-m4">
            <section class="widget">
                <main class="widget-body">
                    <section class="row row-no-mb">
                        <div class="col s12 m12 l10 offset-l1">
                            <form action="{!! route('login.attempt') !!}" method="POST">
                                {!! csrf_field() !!}
                                <section class="row">
                                    <fieldset class="col s12 input-field">
                                        <input type="text" name="username" id="username">
                                        <label for="username">Username</label>
                                    </fieldset>
                                </section>
                                <section class="row">
                                    <fieldset class="col s12 input-field">
                                        <label>Password</label>
                                        <input type="password" name="password">
                                    </fieldset>
                                </section>
                                <section class="row row-no-mb">
                                    <fieldset class="col s12 input-field center">
                                        <button type="submit" class="btn btn-success center">Login</button>
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