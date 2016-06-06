@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 l6 offset-l3">
            <section class="widget">
                <main class="widget-body">
                    <form action="{!! route('stations.store')!!} " method="POST">
                        {!! csrf_field() !!}
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <label for="name">Station Name</label>
                                <input type="text" name="name" id="name"/>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <button type="submit" class="btn btn-small btn-success right">Add</button>
                            </fieldset>
                        </section>
                    </form>
                </main>
            </section>
        </div>
    </section>
@endsection