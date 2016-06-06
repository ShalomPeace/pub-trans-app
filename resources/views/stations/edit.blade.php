@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 l6 offset-l3">
            <section class="widget">
                <main class="widget-body">
                    <form action="{!! route('stations.update', $station)!!} " method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH"/>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <label for="name">Station Name</label>
                                <input type="text" name="name" id="name" value="{{ $station->name }}"/>
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