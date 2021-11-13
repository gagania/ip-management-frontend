@extends('layouts.app')

@section('content')
<div class="padding_this">
    <p>Edit - {{$result['user']['name']}}</p>
        <div class="form-control row col-md-6">
            <label class="col-md-3">User Name</label>
            <div class="col-md-8">
            <input name="ip" value="{{$result['user']['name']}}" placeholder="" readonly>
            </div>
        </div>
        <div class="form-control row col-md-6">
            <label class="col-md-3">Log Date</label>
            <div class="col-md-8">
            <input name="ip" value="{{$result['log_date']}}" placeholder="" readonly>
            </div>
        </div>
        <a href="{{url('access_log/index')}}"><button>Back</button></a>
</div>
@endsection