@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ url('/topic/' . $topic->id ) }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
        	<h1>{{ $question->question_body }}</h1>

        	<p>Posible answers: </p>
        	<div id="answer_container" class="col-sm-10">
        	 	@foreach($answers as $answer)
		            <div class="form-group row">
		              <div class="col-sm-10 col-sm-offset-1 input-group">
		                <div class="input-group-addon">
		                  <input class="correct_check" type="checkbox" name="answers[{{ $answer }}][is_correct]">
		                </div>
		                <div class="input-group">
		                	{{ $answer->text }}
		                </div>
		              </div>
		            </div>
	          	@endforeach
        	</div>
        </div>
		
		<input type="submit" name='save' class="btn btn-default" value = "Submit Answer"/>
    </form>
</div>
@endsection
