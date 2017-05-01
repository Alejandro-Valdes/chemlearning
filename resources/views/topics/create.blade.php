@extends('layouts.app')

@section('content')
@permission('can_add_topic')
<div class="container">
    <form action="/new-topic" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
	        <input required="required" value="{{ old('name') }}" placeholder="Título del tema" type="text" name = "name" class="form-control" />
        </div>

        <div class="form-group">
        	<textarea required="required" value="{{ old('info') }}" placeholder="Información del tema" type="text" name = "info" class="form-control" rows="15">
        	</textarea> 
        </div>

        <input type="submit" name='save' class="btn btn-default" value = "Guardar" />
    </form>
</div>
@endpermission
@endsection
