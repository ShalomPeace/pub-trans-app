@extends('layout.template')

@section('content')
    <section class="row">
        <div class="col s12 l8 offset-l2">
            <section class="widget">
                <main class="widget-body">
                    <section class="row">
                        <div class="col s12">
                            <a href="{!! route('operators.create') !!}" class="btn btn-small btn-info right">Add Operator</a>
                        </div>
                    </section>
                    <table>
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date Added</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ( ! $operators->isEmpty())
                            @foreach ($operators as $operator)
                                <tr>
                                    <td>{{ $operator->first_name }}</td>
                                    <td>{{ $operator->last_name }}</td>
                                    <td>{{ $operator->created_at->format('F j, Y') }}</td>
                                    <td class="right-align">
                                        <a href="{!! route('operators.show', $operator) !!}">View</a>
                                        <a href="{!! route('operators.edit', $operator) !!}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" align="center">No operators found.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </main>
            </section>
        </div>
    </section>
@endsection