@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Access Log List</h3>
        <div class="table-responsive">
            <table class="table table-primary table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Log Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results['data'] as $result)
                        <tr>
                            <td>{{ $result['id'] }}</td>
                            <td>{{ $result['user']['name'] }}</td>
                            <td>{{ $result['log_date'] }}</td>
                            <td>
                            <a href="{{ url('access_log/edit/'.$result['id']) }}"><button>Edit</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection