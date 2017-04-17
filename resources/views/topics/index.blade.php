@extends('layouts.app')

@section('content')
<div class="container">
@if ( !$topics->count() )
    There is no topics till now. Login and create a new topic now!!!
    <div>
        <a href="{{ url('/new-topic') }}">Add new topic</a>
    </div>

@else
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$title}} <a href="{{ url('/new-topic') }}">Add new topic</a>
                </div>
                <div class="panel-body">
                    @foreach( $topics as $topic )
                        <div class="row">
                            <div class="col-sm-6">
                                {{$topic->name}}
                            </div>
                            <div class="col-sm-2">
 
                                <a class="btn btn-small btn-success" href="{{ URL::to('topic/' . $topic->id) }}">Show</a>

                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-small btn-info" href="{{ URL::to('topic/' . $topic->id . '/edit') }}">Edit</a>
                            </div>
                            <div class="col-sm-2">
                                <form method="POST" action="{{ URL::to('topic/' . $topic->id . '/delete') }}">
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-small btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
</div>
@endsection
