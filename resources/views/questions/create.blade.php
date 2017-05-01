@extends('layouts.app')

@section('content')
@permission('can_add_question')
<div class="container">
    <form action="{{ url('/topic/' . $topic_id . '/new-question') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
        	<input required="required" value="{{ old('question_body') }}" placeholder="Enter question here" type="text" name = "question_body" class="form-control" />

        	<input type="file" name="photo">

        	 <p>Posible answers: </p>
        	 <div id="answer_container" class="col-sm-10">
        	 	@for($i = 1; $i <= 2; $i++)
		            <div class="form-group row">
		              <div class="col-sm-10 col-sm-offset-1 input-group">
		                <div class="input-group-addon">
		                  <input class="correct_check" type="checkbox" name="answers[{{ $i }}][is_correct]">
		                </div>
		                <input type="text" name="answers[{{ $i }}][body]" class="form-control" required>
		              </div>
		            </div>
	          	@endfor
        	 </div>
        	 <div id="add_answer_btn" class="btn btn-default">Agregar Respuesta</div>
        </div>
		
		<input type="submit" name='save' class="btn btn-success" value = "Guardar"/>
    </form>
</div>
@endpermission
@endsection

@section('script')
	let i = 3;
	$('#add_answer_btn').on('click', function(){
		$('#answer_container').append("<div class='form-group row'><div class='col-sm-10 col-sm-offset-1 input-group'><div class='input-group-addon'><input type='checkbox' class='correct_check' name='answers[" + parseInt(i,10) + "][is_correct]'></div><input type='text' name='answers[" + parseInt(i, 10) + "][body]' class='form-control' required></div></div>")
		i++;
	});

	$("form").submit(function(event){

	 	var checkboxs=document.getElementsByClassName("correct_check");
	    var okay = false;
	    for(var i=0,l=checkboxs.length;i<l;i++)
	    {
	        if(checkboxs[i].checked)
	        {
	            okay = true;
	            break;
	        }
	    }

	    if(!okay){
			event.preventDefault();
			alert('Check at least one correct answer');
	    }

	   
	});
@endsection

