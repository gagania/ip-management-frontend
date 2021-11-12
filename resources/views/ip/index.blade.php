@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>IP Address List</h3>
        <a href="{{url('ip/add')}}"><button>Add</button></a>
        <div class="table-responsive">
            <table class="table table-primary table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">IP Address</th>
                        <th scope="col">Label</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results['data'] as $result)
                        <tr>
                            <td>{{ $result['id'] }}</td>
                            <td>{{ $result['ip'] }}</td>
                            <td>{{ $result['label'] }}</td>
                            <td>{{ $result['created_at'] }}</td>
                            <td>{{ $result['updated_at'] }}</td>
                            <td>
                            <a href="{{ url('ip/edit/'.$result['id']) }}"><button>Edit</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection