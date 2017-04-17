@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ URL::to('topic/' . $topic->id . '/update') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
        <input required="required" value="{{ $topic->name }}" placeholder="Enter title here" type="text" name = "name" class="form-control" />
        </div>
        <input type="submit" name='save' class="btn btn-default" value = "Update Topic" />
    </form>
</div>
@endsection
