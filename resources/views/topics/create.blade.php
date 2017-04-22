@extends('layouts.app')

@section('content')
@permission('can_add_topic')
<div class="container">
    <form action="/new-topic" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
	        <input required="required" value="{{ old('name') }}" placeholder="Enter title here" type="text" name = "name" class="form-control" />
        </div>

        <div class="form-group">
        	<textarea required="required" value="{{ old('info') }}" placeholder="Enter topics information here" type="text" name = "info" class="form-control" rows="15">
        	</textarea> 
        </div>

        <input type="submit" name='save' class="btn btn-default" value = "Save Topic" />
    </form>
</div>
@endpermission
@endsection
