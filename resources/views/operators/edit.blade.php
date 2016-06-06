@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 l6 offset-l3">
            <section class="widget">
                <main class="widget-body">
                    <form action="{!! route('operators.update', $operator) !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH"/>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" name="first_name" value="{{ $operator->first_name}}"/>
                                <label for="">First Name</label>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" name="last_name" value="{{ $operator->last_name }}"/>
                                <label for="">Last Name</label>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <button type="submit" class="btn btn-small btn-success right">Save</button>
                            </fieldset>
                        </section>
                    </form>
                </main>
            </section>
        </div>
    </section>
@endsection