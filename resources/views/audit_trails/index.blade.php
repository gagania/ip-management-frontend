@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Audit Trails List</h3>
        <div class="table-responsive">
            <table class="table table-primary table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Action</th>
                        <th scope="col">IP Address</th>
                        <th scope="col">Label</th>
                        <th scope="col">Modify Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results['data'] as $result)
                        <tr>
                            <td>{{ $result['id'] }}</td>
                            <td>{{ $result['user']['name'] }}</td>
                            <td>{{ $result['action'] }}</td>
                            <td>{{ $result['ip'] }}</td>
                            <td>{{ $result['label'] }}</td>
                            <td>{{ $result['modify_date'] }}</td>
                            <td>
                            <a href="{{ url('audit_trails/edit/'.$result['id']) }}"><button>Edit</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection