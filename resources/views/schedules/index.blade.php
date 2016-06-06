@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12">
            <section class="widget">
                <main class="widget-body">
                    <section class="row">
                        <div class="col s12">
                            Search Schedules
                        </div>
                    </section>
                    <section class="row">
                        <div class="col s9">
                            <form action="{!! route('schedules.search') !!}" method="GET">
                                <section class="row">
                                    <fieldset class="col s4 input-field">
                                        <select name="from" class="browser-default">
                                            <option value="" selected>-- From --</option>
                                            @foreach ($stations as $station)
                                                <option value="{{ $station->id }}"{{ !empty($from) && $from == $station->id ? ' selected' : '' }}>{{ $station->name }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                    <fieldset class="col s4 input-field">
                                        <select name="to" class="browser-default">--}}
                                            <option value="" selected>-- To --</option>
                                            @foreach ($stations as $station)
                                                <option value="{{ $station->id }}"{{ !empty($to) && $to == $station->id ? ' selected' : ''  }}>{{ $station->name }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                    <fieldset class="col s4 input-field">
                                        <button type="submit" class="btn btn-success">
                                            Search
                                        </button>
                                    </fieldset>
                                </section>
                            </form>
                        </div>
                        <div class="col s3">
                           @if (auth()->check())
                                <a href="{!! route('schedules.create') !!}" class="btn btn-info right">Add</a>
                           @endif
                        </div>
                    </section>
                    <section class="row">
                        <div class="col s12">
                            @if ( ! $schedules->isEmpty())
                                @foreach ($schedules as $schedule)
                                    <article class="schedules">
                                        <aside class="right">
                                            <a href="{!! route('schedules.show', $schedule) !!}" class="btn btn-small btn-info">View</a>
                                            @if (auth()->check())
                                                <a href="{!! route('schedules.edit', $schedule) !!}" class="btn btn-small btn-success">Edit</a>
                                            @endif
                                        </aside>
                                        <p class="stations">{{ $schedule->departureStation->name }} - {{ $schedule->arrivalStation->name }}</p>
                                        <p><strong>Departure:</strong> <date>{{ $schedule->departureDateTime() }}</date></p>
                                        <p><strong>Arrival:</strong> <date>{{ $schedule->arrivalDateTime() }}</date></p>
                                        <p><stron>Duration:</stron> {{ $schedule->duration() }}</p>
                                        <p><strong>Train Number:</strong> {{ $schedule->train->code }}</p>
                                        <p><strong>Status:</strong> <span class="status-active">Active</span></p>
                                    </article>
                                @endforeach
                            @else

                            @endif
                        </div>
                    </section>
                </main>
            </section>
        </div>
    </section>
@endsection