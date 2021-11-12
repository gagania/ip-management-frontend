@extends('layouts.app')

@section('content')
<div class="padding_this">
    <p>Edit - {{$result["name"]}}</p>
    <form method="POST" action="{{url('category/update')}}">
        <input type="hidden" name="id" value="{{$result['id']}}">
        <input name="name" value="{{$result['name']}}" placeholder="Name..."><br />
        <button type="submit">Edit</button>
        <a href="{{url('category')}}"><button>Back</button></a>
    </form>
    </form>
</div>
@endsection