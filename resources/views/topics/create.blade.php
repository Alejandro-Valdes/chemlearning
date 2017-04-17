@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/new-topic" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
        <input required="required" value="{{ old('name') }}" placeholder="Enter title here" type="text" name = "name" class="form-control" />
        </div>
        <input type="submit" name='save' class="btn btn-default" value = "Save Topic" />
    </form>
</div>
@endsection