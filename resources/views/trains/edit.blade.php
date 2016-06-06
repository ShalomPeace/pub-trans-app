@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 l6 offset-l3">
            <section class="widget">
                <main class="widget-body">
                    <form action="{!! route('trains.update', $train) !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH"/>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" name="code" value="{{ $train->code }}" readonly/>
                                <label for="">Code: </label>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" name="name" value="{{ $train->name }}"/>
                                <label for="">Name: </label>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="number" name="total_seats" value="{{ $train->total_seats }}"/>
                                <label for="">Total Seats</label>
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