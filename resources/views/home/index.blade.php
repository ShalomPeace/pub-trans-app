@extends('layout.template')

@section('content')
    <section class="row row-expand">
        <div class="col s8 offset-s2" style="margin-top: 250px;">
            <form action="{!! route('schedules.search') !!}" method="GET">
                <section class="row row-expand">
                    <fieldset class="col s12 m6 l6 input-field">
                        <select name="from" class="browser-default z-depth-5">
                            <option value="" selected>-- Departure --</option>
                            @foreach ($stations as $station)
                                <option value="{{ $station->id }}">{{ $station->name }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                    <fieldset class="col s12 m6 l6 right input-field">
                        <select name="to" class="browser-default z-depth-5">
                            <option value="" selected>-- Arrival --</option>
                            @foreach ($stations as $station)
                                <option value="{{ $station->id }}">{{ $station->name }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </section>
                <section class="row">
                    <fieldset class="col s12 center">
                        <button type="submit" class="btn btn-success">Search Schedules</button>
                    </fieldset>
                </section>
            </form>
        </div>
    </section>
@endsection