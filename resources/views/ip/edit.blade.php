@extends('layouts.app')

@section('content')
<div class="padding_this">
    <p>Edit - {{$result["ip"]}}</p>
    <form method="POST" action="{{url('ip/update')}}">
        <div class="form-control row col-md-6">
            <label class="col-md-3">Name</label>
            <div class="col-md-8">
            <input name="ip" value="{{$result['ip']}}" placeholder="IP..." readonly>
            </div>
        </div>
        <div class="form-control row col-md-6">
            <label class="col-md-3">Label</label>
            <div class="col-md-8">
            <input name="label" value="{{$result['label']}}" placeholder="IP...">
            </div>
        </div>
        <input type="hidden" name="id" value="{{$result['id']}}">
        <button type="submit">Edit</button>
        <a href="{{url('ip')}}"><button>Back</button></a>
    </form>
    </form>
</div>
@endsection