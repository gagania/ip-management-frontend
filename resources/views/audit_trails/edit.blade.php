@extends('layouts.app')

@section('content')
<div class="padding_this">
    <p>Edit - {{$result["ip"]}}</p>
    <!-- <form method="POST" action="{{url('ip/update')}}"> -->
        <div class="form-control row col-md-6">
            <label class="col-md-3">User Name</label>
            <div class="col-md-8">
            <input name="ip" value="{{$result['user']['name']}}" placeholder="" readonly>
            </div>
        </div>
        <div class="form-control row col-md-6">
            <label class="col-md-3">Action</label>
            <div class="col-md-8">
            <input name="ip" value="{{$result['action']}}" placeholder="" readonly>
            </div>
        </div>
        <div class="form-control row col-md-6">
            <label class="col-md-3">IP Address</label>
            <div class="col-md-8">
            <input name="ip" value="{{$result['ip']}}" placeholder="" readonly>
            </div>
        </div>
        <div class="form-control row col-md-6">
            <label class="col-md-3">Label</label>
            <div class="col-md-8">
            <input name="label" value="{{$result['label']}}" placeholder="..." readonly>
            </div>
        </div>
        <a href="{{url('audit_trails/index')}}"><button>Back</button></a>
    <!-- </form> -->
</div>
@endsection