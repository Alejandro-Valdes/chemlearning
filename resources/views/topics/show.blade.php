@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$topic->name}}
                </div>
                <div>
                    <p>{!! nl2br(e($topic->info)) !!}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-8 col-sm-offset-2">
    		@if ( !$questions->count() )
			    There are no questions yet. @permission('can_add_question')Create a new question to get started! <a href="{{ url('/topic/' . $topic->id . '/new-question') }}">Add new question</a>@endpermission
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
                @permission('can_add_question')
                <a href="{{ url('/topic/' . $topic->id . '/new-question') }}">Add new question</a>
                @endpermission
			@endif
    	</div>
    </div>
</div>
@endsection