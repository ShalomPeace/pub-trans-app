@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12">
            <a href="{!! route('stations.create') !!}" class="btn btn-small btn-info right">Add Station</a>
        </div>
    </section>
    @if ( ! $stations->isEmpty())
        @foreach ($stations->chunk(3) as $chunkStations)
            <section class="row row-no-mb">
                @foreach ($chunkStations as $station)
                    <div class="col s4">
                        <section class="row row-no-mb">
                            <div class="col s12">
                               <div class="card">
                                   <div class="card-content">
                                       <span class="card-title">{{ $station->name }}</span>
                                       <p>{{ $station->totalSchedules() }} Schedule(s)</p>
                                       <br>
                                       <p><strong>Departure:</strong> {{ $station->departureSchedules()->count() }}</p>
                                       <p><strong>Arrival:</strong> {{ $station->arrivalSchedules()->count() }}</p>
                                   </div>
                                   <div class="card-action">
                                       <a href="{!! route('stations.show', $station) !!}">View</a>
                                       @if (auth()->check())
                                       <a href="{!! route('stations.edit', $station) !!}">Edit</a>
                                       @endif
                                   </div>
                               </div>
                            </div>
                        </section>
                    </div>
                @endforeach
            </section>
        @endforeach
    @endif
@endsection