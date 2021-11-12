@extends('layouts.app')

@section('content')
<div class="padding_this">
    <p>Add - Category</p>
    <form method="POST" action="{{url('category/create')}}">
        <input name="name" value="" placeholder="Name..."><br />
        <button type="submit">Add</button>
    </form>
</div>
@endsection