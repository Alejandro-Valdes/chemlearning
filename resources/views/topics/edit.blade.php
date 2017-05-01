@extends('layouts.app')

@section('content')
@permission('can_modify_topic')
<div class="container">
    <form action="{{ URL::to('topic/' . $topic->id . '/update') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
        	<input required="required" value="{{ $topic->name }}" placeholder="Enter title here" type="text" name = "name" class="form-control" />
        </div>

        <div class="form-group">
        	<textarea required="required" placeholder="Enter topics information here" type="text" name = "info" class="form-control" rows="15">{{ $topic->info }}
        	</textarea> 
        </div>

        <input type="submit" name='save' class="btn btn-default" value = "Guardar Cambios" />
    </form>
</div>
@endpermission
@endsection
