@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 l6 offset-l3">
            <section class="widget">
                <main class="widget-body">
                    <form action="{!! route('trains.store') !!}" method="POST">
                        {!! csrf_field() !!}
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" name="code" value="TRN0001"/>
                                <label for="">Code</label>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <input type="text" name="name"/>
                                <label for="">Name</label>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 input-field">
                                <label for="">Total Seats</label>
                                <input type="number" name="total_seats"/>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <button type="submit" class="btn btn-small btn-success right">Add Train</button>
                            </fieldset>
                        </section>
                    </form>
                </main>
            </section>
        </div>
    </section>
@endsection