@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Category List</h3>
            <a href="{{url('category/add')}}"><button>Add</button></a>
        <div class="table-responsive">
            <table class="table table-primary table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results['data'] as $result)
                        <tr>
                            <td>{{ $result['id'] }}</td>
                            <td>{{ $result['name'] }}</td>
                            <td>{{ $result['created_at'] }}</td>
                            <td>{{ $result['updated_at'] }}</td>
                            <td><a href="{{ url('category/edit/'.$result['id']) }}"><button>Edit</button></a>
                            <a href="{{ url('category/delete/'.$result['id']) }}"><button>Delete</button></a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection