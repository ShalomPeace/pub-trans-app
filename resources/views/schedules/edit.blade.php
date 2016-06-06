@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 l8 offset-l2">
            <section class="widget">
                <main class="widget-body">
                    <form action="{!! route('schedules.update', $schedule) !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH"/>
                        <section class="row">
                            <fieldset class="col s12">
                                <label for="">Departure Station</label>
                                <select name="departure_station_id" id="" class="browser-default">
                                    <option value="" selected>-- Select Station --</option>
                                    @foreach ($stations as $station)
                                        <option value="{{ $station->id }}"{{ $station->id == $schedule->departureStation->id ? ' selected' : '' }}>{{ $station->name }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12 m6 l6 input-field">
                                <input type="date" name="departure_date" value="{{ $schedule->departure_date }}"/>
                                <label for="" class="active">Date</label>
                            </fieldset>
                            <fieldset class="col s12 m6 l6 input-field">
                                <input type="time" name="departure_time" value="{{ $schedule->departure_time }}"/>
                                <label for="" class="active">Time</label>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12">
                                <label for="">Arrival Station</label><br>
                                <select name="arrival_station_id" id="" class="browser-default">
                                    <option value="" selected>-- Select Station --</option>
                                    @foreach ($stations as $station)
                                        <option value="{{ $station->id }}"{{ $station->id == $schedule->arrivalStation->id ? ' selected' : '' }}>{{ $station->name }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s6 input-field">
                                <input type="date" name="arrival_date" value="{{ $schedule->arrival_date }}"/>
                                <label for="" class="active">Date</label>
                            </fieldset>
                            <fieldset class="col s6 input-field">
                                <input type="time" name="arrival_time" value="{{ $schedule->arrival_time }}"/>
                                <label for="" class="active">Time</label>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12">
                                <label for="">Train</label>
                                <select name="train_id" id="" class="browser-default">
                                    <option value="" selected>-- Select Train --</option>
                                    @foreach ($trains as $train)
                                        <option value="{{ $train->id }}"{{ $train->id == $schedule->train->id ? ' selected' : '' }}>{{ $train->name }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12">
                                <label for="">Operator</label>
                                <select name="operator_id" id="" class="browser-default">
                                    <option value="" selected>-- Select Operator --</option>
                                    @foreach ($operators as $operator)
                                        <option value="{{ $operator->id }}"{{ $operator->id == $schedule->operator->id ? ' selected' : '' }}>{{ $operator->name() }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </section>
                        <section class="row">
                            <fieldset class="col s12">
                                <label for="">Status</label>
                                <select name="status" class="browser-default">
                                    <option value="">Active</option>
                                    <option value=""></option>
                                </select>
                            </fieldset>
                        </section>
                        <section class="row row-no-mb">
                            <fieldset class="col s12 input-field">
                                <button class="btn btn-small btn-success right">
                                    Update
                                </button>
                            </fieldset>
                        </section>
                    </form>
                </main>
            </section>
        </div>
    </section>
@endsection