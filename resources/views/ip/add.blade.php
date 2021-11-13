@extends('layouts.app')

@section('content')
<div class="padding_this">
    <p>Add - Post</p>
    <form method="POST" action="{{url('ip/create')}}">
        <div class="form-control row col-md-6">
            @if (isset($results))
                <span>{{ $results }}</span>
                <br/>
            @endif
            <label class="col-md-3">IP Address</label>
            <div class="col-md-8">
            <input name="ip" value="" placeholder="IP...">
            </div>
        </div>
        <div class="form-control row col-md-6">
            <label class="col-md-3">Label</label>
            <div class="col-md-8">
            <input name="label" value="" placeholder="Label...">
            </div>
        </div>
        <br />
        <button type="submit">Add</button>
    </form>
</div>
@endsection