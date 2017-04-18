@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$topic->name}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-8 col-sm-offset-2">
    		@if ( !$questions->count() )
			    There is no questions till now. Create a new question now!!! <a href="{{ url('/topic/' . $topic->id . '/new-question') }}">Add new question</a>
			@else
				@foreach( $questions as $question )
                    <div class="row">
                        <div class="col-sm-6">
                            {{$question->question_body}}
                        </div>
                        <div class="col-sm-4">
                            <a href="{{ url('/topic/' . $topic->id . '/question/' . $question->id) }}">Solve</a>
                        </div>
                    </div>
                @endforeach
                <a href="{{ url('/topic/' . $topic->id . '/new-question') }}">Add new question</a>
			@endif
    	</div>
    </div>
</div>
@endsection