@extends('layout.template')

@section('content')
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Date Added</th>
				<th>Added By</th>
                <th colspan="2"></th>
			</tr>
		</thead>
		<tbody>
			@if ( ! $stations->isEmpty())
	            @foreach ($stations as $station)
                    <tr>
                        <td>{{ $station->name }}</td>
                        <td>{{ $station->created_at->format('F j, Y') }}</td>
                        <td>{{ $station->user->name }}</td>
                        <td>
                            <a href="{!! route('stations.show', $station) !!}">View</a>
                            <a href="{!! route('stations.edit', $station) !!}">Edit</a>
                        </td>
                    </tr>
                @endforeach
			@else 

			@endif
		</tbody>
	</table>
    <a href="{!! route('stations.create') !!}">Add Station</a>
@endsection