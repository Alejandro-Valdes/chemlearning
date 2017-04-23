@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ url('/topic/' . $topic->id . '/question/' . $question->id) }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">


        <div class="panel panel-primary">
          <div class="panel-heading">
            <h1>{{ $question->question_body }}</h1>
          </div>
        	<div id="answer_container" class="well">
            <p class="col-sm-8 col-sm-offset-0.5">Posibles respuestas: </p>
            <ul class="list-group checked-list-box">
        	 	@foreach($answers as $answer)
		            <div class="form-group row">
		              <div class="col-sm-10 col-sm-offset-1 input-group">
		                <span class="input-group-addon">
		                  <input class="correct_check" type="checkbox" name="answers[{{ $answer->id }}][is_correct]">
		                </span>
		                <li class="list-group-item">{{ $answer->text }}</li>
		              </div>
		            </div>
	          	@endforeach
            </ul>
        	</div>
        </div>
      </div>
        <p align="right">
		        <input type="submit" name='save' class="btn btn-default" value = "Submit"/>
        </p>
    </form>
</div>
@endsection
