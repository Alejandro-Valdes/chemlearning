@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>{{$topic->name}}</h3>
                </div>
                <div class="panel-body">
                    <p>{!! nl2br(e($topic->info)) !!}</p>
                </div>
                <div class="row">
                	<div class="col-sm-8 col-sm-offset-2">
                		@if ( !$questions->count() )
            			    There are no questions yet. @permission('can_add_question')Create a new question to get started! <a href="{{ url('/topic/' . $topic->id . '/new-question') }}">Add new question</a>@endpermission
            			@else
              <table class="table">
                <thead>
                  <tr>
                    <th>Preguntas</th>
                  </tr>
                </thead>
            		@foreach( $questions as $question )
                <tbody>
                  <tr>
                    <td>{{$question->question_body}}</td>
                    <td><a href="{{ url('/topic/' . $topic->id . '/question/' . $question->id) }}">Contestar</a></td>
                  </tr>
                </tbody>
                @endforeach
              </table>

              @permission('can_add_question')
              <a href="{{ url('/topic/' . $topic->id . '/new-question') }}">Añadir nueva pregunta</a>
              @endpermission
                  <br><br>
            			@endif
                	</div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
